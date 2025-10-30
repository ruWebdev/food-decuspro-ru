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
      <div><strong>Максимальное удаление от МКАД:</strong> {{ result.maxOutsideMKAD.toFixed(2) }} км</div>
      <div><strong>Точек за МКАД:</strong> {{ result.pointsOutsideCount }}</div>
      <div><strong>Итого:</strong> {{ formatRub(result.totalCost) }}</div>
    </div>

    <div id="map" style="height:500px; border:1px solid #ddd" class="rounded"></div>

    <div v-if="mkadDetail" class="mt-4 p-4 border rounded bg-blue-50" style="display:none;">
      <div class="font-medium mb-2 text-blue-900">Расчёт за МКАД (подробно):</div>
      <div class="text-sm" v-html="mkadDetail"></div>
    </div>

    <div v-if="result" class="mt-4 p-3 border rounded bg-gray-50">
      <div class="font-medium mb-2">Подробный расчет</div>
      <ul class="list-disc ml-6">
        <li v-for="(row, i) in result.breakdown" :key="i">
          {{ row.label }} — {{ formatRub(row.amount) }}
        </li>
      </ul>
      <div class="mt-2 text-sm text-gray-700">
        Длина маршрута: {{ result.distanceKm.toFixed(2) }} км
        · За МКАД: {{ result.maxOutsideMKAD.toFixed(2) }} км
        · Точек за МКАД: {{ result.pointsOutsideCount }}
      </div>
      <div class="mt-2 text-lg"><strong>Итого: {{ formatRub(result.totalCost) }}</strong></div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, nextTick } from 'vue'

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
const mkadDetail = ref('') // ← Новый: подробный расчёт за МКАД

let map = null, currentRoute = null, scriptEl = null

// Кэш ближайших точек МКАД
const mkadCache = new Map()

function addPoint() { points.value.push({ address: '' }) }
function removePoint(i) { if (points.value.length > 2) points.value.splice(i, 1) }

function unloadYandex() {
  if (scriptEl) scriptEl.remove()
  delete window.ymaps
  ymapsLoaded.value = false
  mkadCache.clear()
}

function loadYandex() {
  if (!apiKey.value) { loadError.value = 'Введите API ключ'; return }
  if (window.ymaps) { ymapsLoaded.value = true; return }
  scriptEl = document.createElement('script')
  scriptEl.src = `https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=${encodeURIComponent(apiKey.value)}`
  scriptEl.onload = () => { if (window.ymaps) ymaps.ready(() => ymapsLoaded.value = true) }
  scriptEl.onerror = () => { loadError.value = 'Ошибка загрузки API' }
  document.head.appendChild(scriptEl)
}

function formatRub(v) { return new Intl.NumberFormat('ru-RU').format(Math.round(v)) + ' ₽' }

// Контур МКАД (lat, lon)
const mkadKm = [
  [1, 37.842762, 55.774558], [2, 37.842789, 55.76522], [3, 37.842627, 55.755723], [4, 37.841828, 55.747399],
  [5, 37.841217, 55.739103], [6, 37.840175, 55.730482], [7, 37.83916, 55.721939], [8, 37.837121, 55.712203],
  [9, 37.83262, 55.703048], [10, 37.829512, 55.694287], [11, 37.831353, 55.68529], [12, 37.834605, 55.675945],
  [13, 37.837597, 55.667752], [14, 37.839348, 55.658667], [15, 37.833842, 55.650053], [16, 37.824787, 55.643713],
  [17, 37.814564, 55.637347], [18, 37.802473, 55.62913], [19, 37.794235, 55.623758], [20, 37.781928, 55.617713],
  [21, 37.771139, 55.611755], [22, 37.758725, 55.604956], [23, 37.747945, 55.599677], [24, 37.734785, 55.594143],
  [25, 37.723062, 55.589234], [26, 37.709425, 55.583983], [27, 37.696256, 55.578834], [28, 37.683167, 55.574019],
  [29, 37.668911, 55.571999], [30, 37.647765, 55.573093], [31, 37.633419, 55.573928], [32, 37.616719, 55.574732],
  [33, 37.60107, 55.575816], [34, 37.586536, 55.5778], [35, 37.571938, 55.581271], [36, 37.555732, 55.585143],
  [37, 37.545132, 55.587509], [38, 37.526366, 55.5922], [39, 37.516108, 55.594728], [40, 37.502274, 55.60249],
  [41, 37.49391, 55.609685], [42, 37.484846, 55.617424], [43, 37.474668, 55.625801], [44, 37.469925, 55.630207],
  [45, 37.456864, 55.641041], [46, 37.448195, 55.648794], [47, 37.441125, 55.654675], [48, 37.434424, 55.660424],
  [49, 37.42598, 55.670701], [50, 37.418712, 55.67994], [51, 37.414868, 55.686873], [52, 37.407528, 55.695697],
  [53, 37.397952, 55.702805], [54, 37.388969, 55.709657], [55, 37.383283, 55.718273], [56, 37.378369, 55.728581],
  [57, 37.374991, 55.735201], [58, 37.370248, 55.744789], [59, 37.369188, 55.75435], [60, 37.369053, 55.762936],
  [61, 37.369619, 55.771444], [62, 37.369853, 55.779722], [63, 37.372943, 55.789542], [64, 37.379824, 55.79723],
  [65, 37.386876, 55.805796], [66, 37.390397, 55.814629], [67, 37.393236, 55.823606], [68, 37.395275, 55.83251],
  [69, 37.394709, 55.840376], [70, 37.393056, 55.850141], [71, 37.397314, 55.858801], [72, 37.405588, 55.867051],
  [73, 37.416601, 55.872703], [74, 37.429429, 55.877041], [75, 37.443596, 55.881091], [76, 37.459065, 55.882828],
  [77, 37.473096, 55.884625], [78, 37.48861, 55.888897], [79, 37.5016, 55.894232], [80, 37.513206, 55.899578],
  [81, 37.527597, 55.90526], [82, 37.543443, 55.907687], [83, 37.559577, 55.909388], [84, 37.575531, 55.910907],
  [85, 37.590344, 55.909257], [86, 37.604637, 55.905472], [87, 37.619603, 55.901637], [88, 37.635961, 55.898533],
  [89, 37.647648, 55.896973], [90, 37.667878, 55.895449], [91, 37.681721, 55.894868], [92, 37.698807, 55.893884],
  [93, 37.712363, 55.889094], [94, 37.723636, 55.883555], [95, 37.735791, 55.877501], [96, 37.741261, 55.874698],
  [97, 37.764519, 55.862464], [98, 37.765992, 55.861979], [99, 37.788216, 55.850257], [100, 37.788522, 55.850383],
  [101, 37.800586, 55.844167], [102, 37.822819, 55.832707], [103, 37.829754, 55.828789], [104, 37.837148, 55.821072],
  [105, 37.838926, 55.811599], [106, 37.840004, 55.802781], [107, 37.840965, 55.793991], [108, 37.841576, 55.785017]
]
const MKAD_POLYGON = mkadKm.map(([, lon, lat]) => [lat, lon])

function pointInPolygon(lat, lon, polygon) {
  let inside = false
  for (let i = 0, j = polygon.length - 1; i < polygon.length; j = i++) {
    const xi = polygon[i][0], yi = polygon[i][1]
    const xj = polygon[j][0], yj = polygon[j][1]
    const intersect = ((yi > lon) !== (yj > lon)) && (lat < (xj - xi) * (lon - yi) / (yj - yi + 1e-12) + xi)
    if (intersect) inside = !inside
  }
  return inside
}

function geodistance(a, b) {
  if (!a || !b || a.length < 2 || b.length < 2) return 0
  if (window.ymaps?.coordSystem?.geo) return ymaps.coordSystem.geo.getDistance(a, b)
  const toRad = d => d * Math.PI / 180
  const R = 6371000
  const dLat = toRad(b[0] - a[0]), dLon = toRad(b[1] - a[1])
  const lat1 = toRad(a[0]), lat2 = toRad(b[0])
  const x = Math.sin(dLat / 2) ** 2 + Math.cos(lat1) * Math.cos(lat2) * Math.sin(dLon / 2) ** 2
  return 2 * R * Math.asin(Math.sqrt(x))
}

// Кэшированная ближайшая точка МКАД
function findClosestMKADPoint(point) {
  const key = point.join(',')
  if (mkadCache.has(key)) return mkadCache.get(key)
  let minDist = Infinity, closest = MKAD_POLYGON[0]
  for (const p of MKAD_POLYGON) {
    const d = geodistance(point, p)
    if (d < minDist) { minDist = d; closest = p }
  }
  mkadCache.set(key, closest)
  return closest
}

// Расстояние до ближайшей точки МКАД (по воздуху)
function findDistanceToMKAD(point) {
  return geodistance(point, findClosestMKADPoint(point)) / 1000
}

// Получить точки за МКАД в порядке маршрута
async function getPointsOutsideInOrder(route) {
  const wayPoints = route.getWayPoints?.().toArray() || []
  const outside = []
  for (const wp of wayPoints) {
    const coords = wp.geometry.getCoordinates()
    if (!pointInPolygon(coords[0], coords[1], MKAD_POLYGON)) {
      const dist = findDistanceToMKAD(coords)
      outside.push({
        coords,
        address: wp.properties.get('name') || 'Неизвестно',
        dist
      })
    }
  }
  return outside
}

// Одна точка за МКАД
function calculateSinglePointOutside(distance, truck) {
  if (distance <= 10) {
    return { cost: 0, description: '≤10 км — бесплатно', detail: 'Не тарифицируется' }
  } else if (distance <= 20) {
    return { cost: truck.hourlyRate, description: '10–20 км — +1 час', detail: `+${formatRub(truck.hourlyRate)}` }
  } else {
    const billable = (distance - 20) * 2
    const cost = billable * truck.rubPerKmMKAD
    return {
      cost,
      description: `>20 км — ${(distance - 20).toFixed(1)}×2 × ${truck.rubPerKmMKAD} ₽/км`,
      detail: `${billable.toFixed(1)} км × ${truck.rubPerKmMKAD} ₽/км = ${formatRub(cost)}`
    }
  }
}

// Несколько точек за МКАД — по дорогам
async function calculateMultiplePointsOutside(route, truck) {
  const outsidePoints = await getPointsOutsideInOrder(route)
  if (outsidePoints.length === 0) return { cost: 0, description: 'Нет точек за МКАД', detail: '' }
  if (outsidePoints.length === 1) return calculateSinglePointOutside(outsidePoints[0].dist, truck)

  const first = outsidePoints[0], last = outsidePoints[outsidePoints.length - 1]
  const mkadStart = findClosestMKADPoint(first.coords)
  const mkadEnd = findClosestMKADPoint(last.coords)

  try {
    const [r1, r2, r3] = await Promise.all([
      ymaps.route([mkadStart, first.coords], { avoid: 'tolls' }),
      outsidePoints.length > 1 ? ymaps.route(outsidePoints.map(p => p.coords), { avoid: 'tolls' }) : null,
      ymaps.route([last.coords, mkadEnd], { avoid: 'tolls' })
    ])

    const d1 = (r1.getLength?.() || 0) / 1000
    const d2 = outsidePoints.length > 1 ? (r2.getLength?.() || 0) / 1000 : 0
    const d3 = (r3.getLength?.() || 0) / 1000
    const total = d1 + d2 + d3
    const cost = total * truck.rubPerKmMKAD

    const detail = `
      МКАД → 1-я: ${d1.toFixed(1)} км<br>
      Между точками: ${d2.toFixed(1)} км<br>
      Последняя → МКАД: ${d3.toFixed(1)} км<br>
      Итого: ${total.toFixed(1)} км × ${truck.rubPerKmMKAD} ₽/км = ${formatRub(cost)}
    `.trim()

    return {
      cost,
      description: `За МКАД: ${total.toFixed(1)} км × ${truck.rubPerKmMKAD} ₽/км`,
      detail
    }
  } catch (e) {
    console.error('Ошибка маршрута за МКАД', e)
    const maxDist = Math.max(...outsidePoints.map(p => p.dist))
    const cost = maxDist * 2 * truck.rubPerKmMKAD
    return {
      cost,
      description: `Резерв: макс ${maxDist.toFixed(1)} × 2 × ${truck.rubPerKmMKAD} ₽/км`,
      detail: `Макс удаление: ${maxDist.toFixed(1)} км → ${cost.toFixed(0)} ₽ (резерв)`
    }
  }
}

async function calculateRoute() {
  if (!ymapsLoaded.value) return alert('Загрузите API')
  loading.value = true; result.value = null; mkadDetail.value = ''

  try {
    await new Promise((res, rej) => {
      let t = 0, id = setInterval(() => {
        if (window.ymaps) { clearInterval(id); res() }
        if ((t += 200) > 10000) { clearInterval(id); rej('timeout') }
      }, 200)
    })

    const addresses = points.value.map(p => p.address).filter(a => a.trim())
    if (addresses.length < 2) return alert('Минимум 2 адреса')

    if (!map) map = new ymaps.Map('map', { center: [55.76, 37.64], zoom: 8 })
    if (currentRoute) map.geoObjects.remove(currentRoute)

    const route = await ymaps.route(addresses, { routingMode: 'auto' })
    const finalRoute = Array.isArray(route) ? route[0] : route
    map.geoObjects.add(finalRoute); currentRoute = finalRoute
    if (finalRoute.getBounds) map.setBounds(finalRoute.getBounds(), { zoomMargin: 20 })

    const lengthMeters = finalRoute.getLength?.() || 0
    const distanceKm = lengthMeters / 1000

    const t = selectedTruck.value
    const breakdown = []
    let total = 0

    // База
    total += t.minOrder
    breakdown.push({ label: 'Минимальный заказ', amount: t.minOrder })

    // Доп. точки
    const included = t.id === 't1' ? 6 : ['t3', 't4_8'].includes(t.id) ? 2 : 1
    const extraPts = Math.max(0, unloadPoints.value - included)
    if (extraPts > 0) {
      const add = extraPts * t.extraPointCost
      breakdown.push({ label: `Доп. точки выгрузки (${extraPts})`, amount: add })
      total += add
    }

    // Доп. км
    const overKm = Math.max(0, distanceKm - t.maxRouteKm)
    if (overKm > 0) {
      const add = overKm * t.rubPerKm
      breakdown.push({ label: `Доп. км (${overKm.toFixed(1)})`, amount: add })
      total += add
    }

    // За МКАД
    const outsideCalc = await calculateMultiplePointsOutside(finalRoute, t)
    if (outsideCalc.cost > 0 || outsideCalc.description.includes('бесплатно')) {
      breakdown.push({ label: `За МКАД: ${outsideCalc.description}`, amount: outsideCalc.cost })
      total += outsideCalc.cost
    }
    mkadDetail.value = outsideCalc.detail || outsideCalc.description

    // Переработка
    if (extraHours.value > 0) {
      const add = extraHours.value * t.hourlyRate
      breakdown.push({ label: `Переработка (${extraHours.value} ч)`, amount: add })
      total += add
    }

    result.value = {
      distanceKm,
      maxOutsideMKAD: outsideCalc.maxDist || 0,
      pointsOutsideCount: (await getPointsOutsideInOrder(finalRoute)).length,
      totalCost: total,
      breakdown
    }

  } catch (e) {
    console.error(e)
    alert('Ошибка: ' + e.message)
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
body {
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial
}
</style>