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
      <label class="block font-medium mb-1">Точки маршрута (минимум 2)</label>
      <div v-for="(pt, idx) in points" :key="idx" class="flex gap-2 items-center mb-2">
        <input v-model="pt.address" :placeholder="`Адрес ${idx + 1}`" class="flex-1 p-2 border rounded" />
        <button @click="removePoint(idx)" class="px-2 py-1 border rounded">Удалить</button>
      </div>
      <button @click="addPoint" class="px-3 py-1 border rounded">Добавить точку</button>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1">Грузовик</label>
      <select v-model="selectedTruck" class="p-2 border rounded" style="width: 200px;">
        <option v-for="t in trucks" :key="t.id" :value="t">{{ t.label }}</option>
      </select>
    </div>

    <div class="mb-4 flex gap-4 items-end">
      <div>
        <label class="block font-medium mb-1">Количество точек выгрузки</label>
        <input type="number" v-model.number="unloadPoints" min="1" class="p-2 border rounded w-32" />
      </div>

      <div>
        <label class="block font-medium mb-1">Часы переработки</label>
        <input type="number" v-model.number="extraHours" min="0" class="p-2 border rounded w-32" />
      </div>

      <button @click="calculateRoute" :disabled="!ymapsLoaded || points.length < 2"
        class="px-4 py-2 bg-blue-600 text-white rounded">Посчитать</button>
    </div>

    <div v-if="loading" class="mb-4">Строим маршрут и считаем...</div>

    <div v-if="result" class="mb-4 p-3 border rounded bg-gray-50">
      <div><strong>Расстояние маршрута:</strong> {{ result.distanceKm.toFixed(2) }} км</div>
      <div><strong>Удаление от МКАД:</strong> {{ result.maxOutsideMKAD.toFixed(2) }} км</div>
      <div><strong>Итого:</strong> {{ formatRub(result.totalCost) }}</div>
    </div>

    <div id="map" style="height:500px; border:1px solid #ddd" class="rounded"></div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const trucks = [
  { id: 't1', label: '1.5 т (4 паллет)', minOrder: 9550, hourlyRate: 955, maxRouteKm: 80, rubPerKm: 33, rubPerKmMKAD: 33, extraPointCost: 955 },
  { id: 't3', label: '3 т (7 паллет)', minOrder: 11450, hourlyRate: 1145, maxRouteKm: 70, rubPerKm: 36, rubPerKmMKAD: 36, extraPointCost: 1145 },
  { id: 't4_8', label: '4.8 т (10 паллет)', minOrder: 13400, hourlyRate: 1340, maxRouteKm: 70, rubPerKm: 38, rubPerKmMKAD: 38, extraPointCost: 1340 },
  { id: 't8_8', label: '8.8 т (18 паллет)', minOrder: 18000, hourlyRate: 1800, maxRouteKm: 70, rubPerKm: 42, rubPerKmMKAD: 42, extraPointCost: 1800 },
  { id: 't20', label: '20 т (33 паллет)', minOrder: 26720, hourlyRate: 2100, maxRouteKm: 70, rubPerKm: 48, rubPerKmMKAD: 48, extraPointCost: 3340 }
]

const apiKey = ref('3488d80b-a08a-4301-ae5a-617ece4bd5fe')
const ymapsLoaded = ref(false)
const loadError = ref('')
const points = ref([{ address: '' }, { address: '' }])
const selectedTruck = ref(trucks[0])
const unloadPoints = ref(1)
const extraHours = ref(0)
const loading = ref(false)
const result = ref(null)
let map = null, currentRoute = null, scriptEl = null

function addPoint() { points.value.push({ address: '' }) }
function removePoint(i) { if (points.value.length > 2) points.value.splice(i, 1) }

function unloadYandex() { if (scriptEl) scriptEl.remove(); delete window.ymaps; ymapsLoaded.value = false; }

function loadYandex() {
  if (!apiKey.value) { loadError.value = 'Введите API ключ'; return }
  if (window.ymaps) { ymapsLoaded.value = true; return }
  scriptEl = document.createElement('script')
  scriptEl.src = `https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=${encodeURIComponent(apiKey.value)}`
  scriptEl.onload = () => { if (window.ymaps) ymaps.ready(() => ymapsLoaded.value = true) }
  scriptEl.onerror = () => { loadError.value = 'Ошибка загрузки API (проверьте ключ или ограничения)' }
  document.head.appendChild(scriptEl)
}

function formatRub(v) { return new Intl.NumberFormat('ru-RU').format(Math.round(v)) + ' ₽' }

async function calculateRoute() {
  if (!ymapsLoaded.value) return alert('Загрузите API Яндекс.Карт')
  loading.value = true; result.value = null
  try {
    await new Promise((res, rej) => { let t = 0; const id = setInterval(() => { if (window.ymaps) { clearInterval(id); res() } if ((t += 200) > 1e4) { clearInterval(id); rej('timeout') } }, 200) })
    const addresses = points.value.map(p => p.address).filter(a => a.trim())
    if (addresses.length < 2) return alert('Нужно минимум 2 адреса')

    if (!map) map = new ymaps.Map('map', { center: [55.76, 37.64], zoom: 8 })
    if (currentRoute) map.geoObjects.remove(currentRoute)

    let route = await ymaps.route(addresses, { routingMode: 'auto' })

    // если массив — берём первый элемент
    if (Array.isArray(route)) route = route[0]

    // безопасная установка границ
    if (route.getBounds) map.setBounds(route.getBounds(), { checkZoomRange: true, zoomMargin: 20 })

    map.geoObjects.add(route); currentRoute = route

    // получение длины и времени безопасно через свойства
    let lengthMeters = 0, timeSec = 0
    try {
      const props = route.properties.getAll() || {}
      lengthMeters = props.distance?.value || route.getLength?.() || 0
      timeSec = props.duration?.value || route.getTime?.() || 0
    } catch (e) { lengthMeters = route.getLength?.() || 0 }

    const distanceKm = lengthMeters / 1000

    // безопасный обход координат маршрута
    const mkadCenter = [55.751244, 37.618423], mkadRadius = 16.5
    let maxOutsideMKAD = 0
    try {
      if (route.getPaths) {
        for (const path of route.getPaths().toArray()) {
          const segments = path.getSegments?.() || []
          for (const seg of segments) {
            const coords = seg.geometry?.getCoordinates?.() || []
            for (const c of coords) {
              const dist = ymaps.coordSystem.geo.getDistance(c, mkadCenter) / 1000
              const outside = dist - mkadRadius
              if (outside > maxOutsideMKAD) maxOutsideMKAD = outside
            }
          }
        }
      }
    } catch (e) { console.warn('Ошибка анализа геометрии', e) }

    const t = selectedTruck.value
    let total = t.minOrder
    const included = t.id === 't1' ? 6 : t.id === 't3' ? 2 : t.id === 't4_8' ? 2 : t.id === 't8_8' ? 1 : 1
    const extraPts = Math.max(0, unloadPoints.value - included)
    if (extraPts > 0) total += extraPts * t.extraPointCost
    const overKm = Math.max(0, distanceKm - t.maxRouteKm)
    if (overKm > 0) total += overKm * t.rubPerKm
    if (maxOutsideMKAD > 20) total += (maxOutsideMKAD - 20) * t.rubPerKmMKAD
    if (extraHours.value > 0) total += extraHours.value * t.hourlyRate

    result.value = { distanceKm, maxOutsideMKAD, totalCost: total }
  } catch (e) {
    console.error('Ошибка маршрута', e)
  } finally { loading.value = false }
}
</script>

<style scoped>
body {
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial
}
</style>