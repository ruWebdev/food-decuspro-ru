<template>
  <div class="p-4 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Калькулятор перевозки — Неска-СТС</h1>

    <div class="mb-4">
      <label class="block font-medium mb-1">API ключ Яндекс.Карт</label>
      <input v-model="apiKey" placeholder="Вставьте API-ключ" class="w-full p-2 border rounded" />
      <div class="flex gap-2 mt-2">
        <button @click="loadYandex" class="px-3 py-1 border rounded">Загрузить API</button>
        <button @click="unloadYandex" class="px-3 py-1 border rounded">Выгрузить</button>
      </div>
      <div v-if="ymapsLoaded" class="text-sm text-green-700 mt-1">Yandex.Maps загружен</div>
      <div v-if="loadError" class="text-sm text-red-700 mt-1">Ошибка загрузки: {{ loadError }}</div>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1">Точки маршрута (минимум 2). Поддерживается несколько точек — нажимайте
        «Добавить точку»</label>
      <div v-for="(pt, idx) in points" :key="idx" class="flex gap-2 items-center mb-2">
        <input v-model="pt.address" :placeholder="`Адрес ${idx + 1}`" class="flex-1 p-2 border rounded" />
        <button @click="removePoint(idx)" class="px-2 py-1 border rounded">Удалить</button>
      </div>
      <button @click="addPoint" class="px-3 py-1 border rounded">Добавить точку</button>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1">Грузовик</label>
      <select v-model="selectedTruck" class="p-2 border rounded">
        <option v-for="t in trucks" :key="t.id" :value="t">{{ t.label }}</option>
      </select>
    </div>

    <div class="mb-4 flex gap-4 items-end">
      <div>
        <label class="block font-medium mb-1">Количество точек выгрузки</label>
        <input type="number" v-model.number="unloadPoints" min="1" class="p-2 border rounded w-32" />
      </div>

      <div>
        <label class="block font-medium mb-1">Часы переработки (если есть)</label>
        <input type="number" v-model.number="extraHours" min="0" class="p-2 border rounded w-32" />
      </div>

      <button @click="calculateRoute" :disabled="!ymapsLoaded || points.length < 2"
        class="px-4 py-2 bg-blue-600 text-white rounded">Посчитать</button>
    </div>

    <div v-if="loading" class="mb-4">Строим маршрут и считаем...</div>

    <div v-if="result" class="mb-4 p-3 border rounded bg-gray-50">
      <div><strong>Расстояние маршрута:</strong> {{ result.distanceKm.toFixed(2) }} км</div>
      <div><strong>Удаление от МКАД (максимум):</strong> {{ result.maxOutsideMKAD.toFixed(2) }} км</div>
      <div><strong>Время в пути (ч):</strong> {{ (result.timeSec / 3600).toFixed(2) }}</div>
      <div><strong>Подсчёт стоимости:</strong></div>
      <ul class="list-disc ml-6">
        <li>Базовый (минимальный заказ): {{ formatRub(selectedTruck.minOrder) }}</li>
        <li v-if="extraPoints > 0">Доп. точки: {{ extraPoints }} × {{ formatRub(selectedTruck.extraPointCost) }} = {{
          formatRub(extraPoints * selectedTruck.extraPointCost) }}</li>
        <li v-if="distanceOverKm > 0">Доп. км: {{ distanceOverKm.toFixed(2) }} × {{ formatRub(selectedTruck.rubPerKm) }} =
          {{ formatRub(distanceOverKm * selectedTruck.rubPerKm) }}</li>
        <li v-if="result.maxOutsideMKAD > 20">Удаление от МКАД ({{ result.maxOutsideMKAD.toFixed(2) }} км) × {{
          formatRub(selectedTruck.rubPerKmMKAD) }} = {{ formatRub((result.maxOutsideMKAD - 20) *
            selectedTruck.rubPerKmMKAD) }}</li>
        <li v-if="extraHours > 0">Переработка часов: {{ extraHours }} × {{ formatRub(selectedTruck.hourlyRate) }} = {{
          formatRub(extraHours * selectedTruck.hourlyRate) }}</li>
      </ul>
      <div class="mt-2 text-lg"><strong>Итого: {{ formatRub(result.totalCost) }}</strong></div>
    </div>

    <div id="map" style="height:500px; border:1px solid #ddd" class="rounded"></div>

    <div class="mt-4 text-sm text-gray-600">
      <p><strong>Диагностика ошибок загрузки/маршрута:</strong></p>
      <ul class="ml-6 list-disc">
        <li v-if="lastRouteError">Ошибка маршрута: {{ lastRouteError }}</li>
        <li v-else>Ошибок маршрута нет.</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, watch } from 'vue'

const trucks = [
  { id: 't1', label: '1.5 т (4 паллет)', minHours: 10, minOrder: 9550, hourlyRate: 955, maxRouteKm: 80, rubPerKm: 33, rubPerKmMKAD: 33, extraPointCost: 955 },
  { id: 't3', label: '3 т (7 паллет)', minHours: 10, minOrder: 11450, hourlyRate: 1145, maxRouteKm: 70, rubPerKm: 36, rubPerKmMKAD: 36, extraPointCost: 1145 },
  { id: 't4_8', label: '4.8 т (10 паллет)', minHours: 10, minOrder: 13400, hourlyRate: 1340, maxRouteKm: 70, rubPerKm: 38, rubPerKmMKAD: 38, extraPointCost: 1340 },
  { id: 't8_8', label: '8.8 т (18 паллет)', minHours: 10, minOrder: 18000, hourlyRate: 1800, maxRouteKm: 70, rubPerKm: 42, rubPerKmMKAD: 42, extraPointCost: 1800 },
  { id: 't20', label: '20 т (33 паллет)', minHours: 8, minOrder: 26720, hourlyRate: 2100, maxRouteKm: 70, rubPerKm: 48, rubPerKmMKAD: 48, extraPointCost: 3340 }
]

const apiKey = ref('')
const ymapsLoaded = ref(false)
const loadError = ref('')
const lastRouteError = ref('')
const points = ref([{ address: '' }, { address: '' }])
const selectedTruck = ref(trucks[0])
const unloadPoints = ref(1)
const extraHours = ref(0)
const loading = ref(false)
const result = ref(null)

let scriptEl = null
function addPoint() { points.value.push({ address: '' }) }
function removePoint(i) { if (points.value.length > 2) points.value.splice(i, 1) }

function unloadYandex() {
  // убираем скрипт и состояние
  if (scriptEl && scriptEl.parentNode) scriptEl.parentNode.removeChild(scriptEl)
  scriptEl = null
  if (window.ymaps) { try { delete window.ymaps } catch (e) { } }
  ymapsLoaded.value = false
  loadError.value = ''
}

function loadYandex() {
  loadError.value = ''
  lastRouteError.value = ''
  if (!apiKey.value) { loadError.value = 'Ключ пустой'; return }
  if (window.ymaps) { ymapsLoaded.value = true; return }

  // если ранее был элемент, удалить
  if (scriptEl && scriptEl.parentNode) scriptEl.parentNode.removeChild(scriptEl)

  scriptEl = document.createElement('script')
  scriptEl.src = `https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=${encodeURIComponent(apiKey.value)}`
  scriptEl.async = true
  scriptEl.defer = true
  scriptEl.onload = () => {
    // ymaps может быть не готов мгновенно, используем ready
    if (window.ymaps && typeof window.ymaps.ready === 'function') {
      window.ymaps.ready(() => { ymapsLoaded.value = true })
    } else {
      // в редких случаях скрипт вернул scriptError — пометим
      loadError.value = 'Скрипт загружен, но ymaps не доступен.'
    }
  }
  scriptEl.onerror = (e) => {
    // частая причина: Invalid API key или блокировка
    loadError.value = 'scriptError'
    // попытка прочитать сообщение из глобального лог-файла Yandex Maps
    // но библиотека кидает 'Invalid API key' прямо в консоль при загрузке
  }
  document.head.appendChild(scriptEl)
}

function formatRub(v) { return new Intl.NumberFormat('ru-RU').format(Math.round(v)) + ' ₽' }

let map = null
let currentRoute = null

async function calculateRoute() {
  if (!ymapsLoaded.value) { alert('Сначала загрузите API Яндекс.Карт (проверьте сообщение об ошибке ниже)'); return }
  loading.value = true
  result.value = null
  lastRouteError.value = ''

  try {
    await waitForYmaps()

    const pointsAddresses = points.value.map(p => p.address).filter(a => a && a.trim().length > 0)
    if (pointsAddresses.length < 2) { alert('Нужно минимум 2 заполненных адреса'); loading.value = false; return }

    if (!map) { map = new ymaps.Map('map', { center: [55.76, 37.64], zoom: 10, controls: [] }) }
    if (currentRoute) { map.geoObjects.remove(currentRoute); currentRoute = null }

    let route
    try {
      route = await ymaps.route(pointsAddresses, { routingMode: 'auto' })
    } catch (e) {
      lastRouteError.value = (e && e.message) ? e.message : JSON.stringify(e)
      throw e
    }

    currentRoute = route
    map.geoObjects.add(route)
    map.setBounds(route.getBounds(), { checkZoomRange: true, zoomMargin: 20 })

    const lengthMeters = route.getLength()
    const timeSec = route.getTime()
    const distanceKm = lengthMeters / 1000

    // Проверяем удаление от МКАД. Используем центр и приблизительный радиус 16.5 км
    const mkadCenter = [55.751244, 37.618423]
    const mkadRadius = 16.5 // km
    let maxOutsideMKAD = 0

    try {
      const paths = route.getPaths().toArray()
      for (const path of paths) {
        const segments = path.getSegments()
        for (const seg of segments) {
          const coords = seg.geometry.getCoordinates()
          for (const c of coords) {
            const dist = ymaps.coordSystem.geo.getDistance(c, mkadCenter) / 1000
            const outside = dist - mkadRadius
            if (outside > maxOutsideMKAD) maxOutsideMKAD = outside
          }
        }
      }
    } catch (e) {
      // если геометрия недоступна по какой-то причине — не фатально
      console.warn('Не удалось полностью пройтись по сегментам маршрута:', e)
    }

    const truck = selectedTruck.value
    let total = truck.minOrder
    const includedPoints = (truck.id === 't1' ? 6 : truck.id === 't3' ? 2 : truck.id === 't4_8' ? 2 : truck.id === 't8_8' ? 1 : 1)
    const extraPointsCount = Math.max(0, unloadPoints.value - includedPoints)
    if (extraPointsCount > 0) total += extraPointsCount * truck.extraPointCost

    const distanceOverKm = Math.max(0, distanceKm - truck.maxRouteKm)
    if (distanceOverKm > 0) total += distanceOverKm * truck.rubPerKm

    // Логика: если максимальное удаление за МКАД более 20 км — платим за (maxOutsideMKAD - 20)
    if (maxOutsideMKAD > 20) total += (maxOutsideMKAD - 20) * truck.rubPerKmMKAD

    if (extraHours.value > 0) total += extraHours.value * truck.hourlyRate

    result.value = { distanceKm, timeSec, totalCost: total, maxOutsideMKAD }

  } catch (err) {
    console.error('calculateRoute error', err)
    if (!lastRouteError.value) lastRouteError.value = (err && err.message) ? err.message : String(err)
  } finally {
    loading.value = false
  }
}

function waitForYmaps() {
  return new Promise((resolve, reject) => {
    const max = 10000
    let waited = 0
    const id = setInterval(() => {
      if (window.ymaps) { clearInterval(id); resolve() }
      waited += 200
      if (waited > max) { clearInterval(id); reject(new Error('ymaps load timeout')) }
    }, 200)
  })
}

const distanceOverKm = ref(0)
const extraPoints = ref(0)
watch(() => result.value, (r) => {
  if (r) {
    const truck = selectedTruck.value
    distanceOverKm.value = Math.max(0, r.distanceKm - truck.maxRouteKm)
    const includedPoints = (truck.id === 't1' ? 6 : truck.id === 't3' ? 2 : truck.id === 't4_8' ? 2 : truck.id === 't8_8' ? 1 : 1)
    extraPoints.value = Math.max(0, unloadPoints.value - includedPoints)
  } else {
    distanceOverKm.value = 0
    extraPoints.value = 0
  }
})
</script>

<style scoped>
body {
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial
}
</style>
