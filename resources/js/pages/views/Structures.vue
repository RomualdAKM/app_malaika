<template>
    <!-- Navigation bar -->
    <div class="shadow-lg mb-2">
        <Nav />
    </div>
    <div class="max-w-screen-xl mx-auto p-4">
        <!-- Header -->
        <div class="flex space-x-4 mb-4">
            <div class="w-full">
                <div class="border border-gray-200 py-1 px-4 rounded-md text-sm flex items-center mb-2"
                    @click.prevent="toggleDestinationFilter">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 me-4">
                        <path fill-rule="evenodd"
                            d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                            clip-rule="evenodd" />
                    </svg>

                    <div>
                        <p class="text-xs">Destination</p>
                        {{ $route.query.destination }}
                    </div>
                </div>

                <div class="absolute w-96 z-50" v-if="isDestinationFilterOpen">
                    <DestinationFilter />
                </div>
            </div>

            <div class="w-full">
                <div class="w-full border border-gray-200 py-1 px-4 rounded-md text-sm flex items-center mb-2"
                    @click.prevent="toggleDateFilter">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 me-4">
                        <path
                            d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                        <path fill-rule="evenodd"
                            d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                            clip-rule="evenodd" />
                    </svg>

                    <div>
                        <p class="text-xs">Dates</p>
                        {{ $route.query.checkInDate }} - {{ $route.query.checkOutDate }}
                    </div>
                </div>

                <div class="absolute w-96" v-if="isDateFilterOpen">
                    <DateFilter />
                </div>
            </div>

            <div class="w-full">
                <div class="border border-gray-200 py-1 px-4 rounded-md text-sm flex items-center mb-2"
                    @click.prevent="toggleRoomPersonFilter()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 me-4">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>

                    <div>
                        <p class="text-xs">Voyageurs, Chambres</p>
                        {{ $route.query.guests }} - {{ $route.query.rooms }}
                    </div>
                </div>

                <div class="absolute w-64" v-if="isRoomPersonFilterOpen">
                    <RoomPersonFilter />
                </div>
            </div>

            <button class="bg-blue-600 text-white p-2 rounded-full w-10 h-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-3 gap-4">
            <div>
                <!-- Map -->
                <div v-if="structures.length != 0" class="border border-slate-200 rounded-lg">
                    <div id='map' class="w-full h-[200px]"></div>
                </div>
                <span class="italic" v-if="equipments.length == 0">Aucune carte à afficher</span>

                <div class="mt-4 text-xs">
                    <div class="font-semibold mb-2">Listes des équipements/services de l'hotêl</div>
                    <form @submit.prevent="">
                        <div v-for="equipment in equipments" :key="equipment.id">
                            <div class="flex items-center">
                                <input type="checkbox" class="mr-2" :id="equipment.id" name="equipments[]"
                                    :value="equipment.id">
                                <label :for="equipment.id">{{ equipment.name }}</label>
                            </div>
                        </div>
                    </form>
                    <span class="italic" v-if="equipments.length == 0">Aucun élément</span>
                </div>
            </div>

            <!-- Listings -->
            <div class="col-span-2">

                <div class="mb-4 flex justify-between text-sm">
                    <p class="text-gray-600">{{ structures.length }} hébergement(s)  </p>

                    <div class="border border-slate-200 rounded-lg px-2">
                        <label for="">Trier par :</label>
                        <select name="" id="filter" class="p-2 bg-white rounded-lg">
                            <option>Prix (croissant)</option>
                            <option>Prix (décroissant)</option>
                            <option>Notes des voyageurs</option>
                        </select>
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg flex h-60" v-for="structure in structures" :key="structure.id">

                  
                    <div class="relative w-full h-full">
                        <div class="h-full overflow-hidden relative">
                            <div class="h-full flex transition-transform duration-500"
                                :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                                <div v-for="(image, index) in structure.images" :key="index"
                                    class="w-full h-full flex-shrink-0 overflow-hidden">
                                  
                                    <img :src="`/photos/${image.path}`" :alt="`${image.path}`"
                                        class="w-full h-full object-cover object-center rounded-lg" />
                                </div>
                            </div>
                            <button @click="prev(structure.images)"
                                class="absolute top-1/2 transform -translate-y-1/2 left-4 bg-gray-800 text-white p-2 rounded-full">
                                &lt;
                            </button>
                            <button @click="next(structure.images)"
                                class="absolute top-1/2 transform -translate-y-1/2 right-4 bg-gray-800 text-white p-2 rounded-full">
                                &gt;
                            </button>
                        </div>
                    </div>

                    <div class="w-2/3 h-full p-4">
                        <router-link :to="{ name: 'room-detail', params: { id: structure.id } }">
                            <h2 class="text-xl font-semibold">{{ structure.name }}</h2>
                            <p class="text-gray-600">{{ structure.address }}</p>
                            <!-- <p class="text-gray-600">
                                <span v-for="(key, keyIndex) in structure.equipment">
                                    {{ key }}
                                    <span v-if="keyIndex !== structure.equipment.length - 1"> | </span>
                                </span>
                            </p> -->
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="text-green-600 font-semibold">{{ structure.rate ?? 0 }}</span>
                                <span class="text-gray-600">({{ structure.evaluations.length }} avis)</span>
                            </div>
                            <div class="flex justify-between w-full items-center mt-4 text-xs">
                                <div class="w-2/3">
                                    {{ structure.description ?? "" }}
                                </div>
                                <div class="w-1/3 text-right">
                                    <!-- <span class="line-through text-gray-500">88 €</span> -->
                                    <!-- <div class="text-red-600 font-semibold text-base">{{ structure.rooms[0].max_price + " - " + structure.rooms[0].min_price }} XOF</div> -->
                                    <div class="text-red-600 font-semibold text-base">{{ structure.rooms[0].path }} {{ structure.rooms[0].min_price }} XOF</div>
                                    <div class="text-gray-500">Tarif journalier</div>
                                </div>
                                <!-- <div class="bg-gray-200 text-gray-600 py-1 px-2 rounded">-15%</div> -->
                            </div>
                        </router-link>
                    </div>
                </div>
                <span class="italic" v-if="structures.length == 0">Aucun élément</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from "vue-router"

import DestinationFilter from '../components/DestinationFilter.vue'
import RoomPersonFilter from '../components/RoomPersonFilter.vue'
import DateFilter from '../components/DateFilter.vue'
import Nav from '../components/Nav.vue'

const isDestinationFilterOpen = ref(false)
const isRoomPersonFilterOpen = ref(false)
const isDateFilterOpen = ref(false)
const allMarkers = ref([])
const equipments = ref([])
const structures = ref([])

let map, markers = [];

// carousel
const currentIndex = ref(0)
const next = (obj) => {
    currentIndex.value = (currentIndex.value + 1) % obj.length
}
const prev = (obj) => {
    currentIndex.value = (currentIndex.value - 1 + obj.length) % obj.length
}

// recuperer les d'entrées de l'utilisateur
const route = useRoute();
let reqs = route.query

// ouvrir les filtres
const toggleDestinationFilter = () => isDestinationFilterOpen.value = !isDestinationFilterOpen.value;

const toggleDateFilter = () => {
    isDateFilterOpen.value = !isDateFilterOpen.value
}

const toggleRoomPersonFilter = () => {
    isRoomPersonFilterOpen.value = !isRoomPersonFilterOpen.value
}

/* ----------------------------- Initialize Map ----------------------------- */
const initMap = (obj) => {
    map = L.map('map', {
        center: {
            lat: 6.3832064,
            lng: 2.441216,
        },
        zoom: 10
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    map.on('click', mapClicked);
    initMarkers(obj);
}

/* --------------------------- Initialize Markers --------------------------- */
const initMarkers = (obj) => {
    const initialMarkers = obj;

    for (let index = 0; index < initialMarkers.length; index++) {

        const data = initialMarkers[index];
        const marker = generateMarker(data, index);
        marker.addTo(map).bindPopup(`<b>${data.position.lat},  ${data.position.lng}</b>`);
        map.panTo(data.position);
        markers.push(marker)
    }
}

const generateMarker = (data, index) => {
    return L.marker(data.position, {
        draggable: data.draggable
    })
        .on('click', (event) => markerClicked(event, index))
        .on('dragend', (event) => markerDragEnd(event, index));
}

/* ------------------------- Handle Map Click Event ------------------------- */
const mapClicked = ($event) => {
    console.log(map);
    console.log($event.latlng.lat, $event.latlng.lng);
}

/* ------------------------ Handle Marker Click Event ----------------------- */
const markerClicked = ($event, index) => {
    console.log(map);
    console.log($event.latlng.lat, $event.latlng.lng);
}

/* ----------------------- Handle Marker DragEnd Event ---------------------- */
const markerDragEnd = ($event, index) => {
    console.log(map);
    console.log($event.target.getLatLng());
}

const getStructures = async () => {
    localStorage.setItem("destination", reqs.destination)
    localStorage.setItem("checkInDate", reqs.checkInDate)
    localStorage.setItem("checkOutDate", reqs.checkOutDate)
    localStorage.setItem("guests", reqs.guests)
    localStorage.setItem("rooms", reqs.rooms)

    await axios.post('api/structure', reqs).then((result) => {
        structures.value = result.data.structures
        equipments.value = result.data.equipments
        allMarkers.value = result.data.initialMarkers

        console.log('strutures', structures.value)
    }).catch((err) => {
    });
}

onMounted(async () => {
    await getStructures()
    if (allMarkers != []) {
        initMap(allMarkers)
    }
})
</script>
