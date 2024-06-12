<template>
    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <Nav />
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-4">
        <!-- Image Gallery -->
        <div class="container mx-auto py-2">
            <div class="-m-1 flex flex-wrap md:-m-2 h-96">
                <div class="flex w-1/2 h-96 flex-wrap">
                    <div class="w-full h-96 p-1 md:p-2" v-if="structure.images">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            :src="`/photos/${structure.images[0].path}`" />
                    </div>
                </div>
                <div class="flex w-1/2 h-48 flex-wrap" v-if="structure.images">
                    <div class="w-1/2 h-48 p-1 md:p-2"
                        v-if="structure.images && structure.images[1] && structure.images[1].path">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            :src="`/photos/${structure.images[1].path}`" />
                    </div>
                    <div class="w-1/2 h-48 p-1 md:p-2"
                        v-if="structure.images && structure.images[2] && structure.images[2].path">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            :src="`/photos/${structure.images[2].path}`" />
                    </div>
                    <div class="w-1/2 h-48 p-1 md:p-2"
                        v-if="structure.images && structure.images[3] && structure.images[3].path">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            :src="`/photos/${structure.images[3].path}`" />
                    </div>
                    <div class="w-1/2 h-48 p-1 md:p-2"
                        v-if="structure.images && structure.images[4] && structure.images[4].path">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            :src="`/photos/${structure.images[4].path}`" />
                    </div>
                </div>
            </div>
        </div>

        <div
            class="flex justify-between pt-4 pb-1 mb-2 text-xs font-semibold sticky top-0 bg-white border-b border-gray-400 z-20">
            <div>
                <a href="#presentation" class="mx-2 pb-5 active:border-b-2 active:border-blue-500 active:text-blue-500">
                    Présentation
                </a>
                <a href="#price" class="mx-2 pb-5 active:border-b-2 active:border-blue-500 active:text-blue-500">
                    Prix
                </a>
                <a href="#condition" class="mx-2 pb-5 active:border-b-2 active:border-blue-500 active:text-blue-500">
                    Conditions
                </a>
            </div>
            <div>
                <button class="bg-blue-500 hover:bg-blue-700 transition-all rounded-full text-white px-6 py-2">
                    Réserver
                </button>
            </div>
        </div>

        <!-- Hotel Info -->
        <h2 id="presentation" class="text-2xl font-bold mb-4" v-if='structure'>{{ structure.name }}</h2>
        <p class="mb-4" v-if='structure.description'>{{ structure.description }}</p>

        <!-- Facilities
        <div class="my-8" v-if='structure.equipment'>
            <h3 id="equipment" class="font-bold">Équipements disponibles</h3>
            <ul class="list-disc ml-5">
                <li v-for="key in structure.equipment">{{ key.name }}</li>
            </ul>
        </div> -->

        <!-- price -->
        <div id="price" class="container mx-auto p-4">
            <div class="mb-4">
                <div class="flex justify-between items-center gap-4 text-xs">
                    <div class="w-full">
                        <label for="checkInDate" class="block text-gray-700">Arrivée</label>
                        <input type="date" id="checkInDate" v-model="checkInDate" class="border rounded p-2 w-full">
                    </div>
                    <div class="w-full">
                        <label for="checkOutDate" class="block text-gray-700">Départ</label>
                        <input type="date" id="checkOutDate" v-model="checkOutDate" class="border rounded p-2 w-full">
                    </div>

                    <div class="w-full">
                        <label for="guests" class="block text-gray-700">Voyageurs, Chambres</label>
                        <div class="border rounded p-2 w-full flex justify-between"
                            @click.prevent="toggleRoomPersonFilter()">
                            <div>
                                {{ guests }} personne(s) - {{ rooms }} chambre(s)
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>

                        <div class="absolute w-64" v-if="isRoomPersonFilterOpen">
                            <RoomPersonFilter />
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded border" v-for="room in structure.rooms" :key="room.id">
                    <!-- <img src="path/to/standard.jpg" alt="Appartement Standard" class="w-full h-48 object-cover rounded"> -->
                    <div class="relative w-full h-48">
                        <div class="h-full overflow-hidden relative">
                            <div class="h-full flex transition-transform duration-500"
                                :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                                <div v-for="(image, index) in room.images" :key="index"
                                    class="w-full h-full flex-shrink-0 overflow-hidden">
                                    <img :src="`/photos/${image.path}`" alt="`${image.path}`"
                                        class="w-full h-full object-cover object-center rounded" />
                                </div>
                            </div>
                            <button @click="prev(room.images)"
                                class="absolute top-1/2 transform -translate-y-1/2 left-4 bg-gray-800 text-white p-2 rounded-full">
                                &lt;
                            </button>
                            <button @click="next(room.images)"
                                class="absolute top-1/2 transform -translate-y-1/2 right-4 bg-gray-800 text-white p-2 rounded-full">
                                &gt;
                            </button>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-bold mt-2">{{ room.name }}</h3>

                        <ul class="mt-2">
                            <li class="flex items-center my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                                </svg>
                                &nbsp;
                                {{ room.area }} m²
                            </li>
                            <li class="flex items-center my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg> &nbsp;
                                {{ room.person }} personnes
                            </li>
                            <span class="text-xs font-semibold mt-2">Equipments disponibles</span>
                            <li v-for="key in room.equipment" :key="key">{{ key.name }}</li>
                        </ul>
                        <div class="mt-2 justify-between items-center">
                            <span class="text-red-600 text-xl font-bold">{{ room.price }} € </span>
                            <span class="text-xs font-semibold">/ tarif journalier</span>
                        </div>
                        <router-link :to="{ name: 'create-reservation', params: { id: room.id } }">
                            <button class="my-2 w-full bg-blue-500 text-white px-4 py-2 rounded">Réserver</button>
                        </router-link>
                    </div>
                    <div class="w-full h-full fixed inset-0 flex items-center justify-center z-50" v-if="isPaymentOpen">
                        <div class="bg-gray-700 opacity-80 absolute w-full h-full z-40"></div>
                        <div class="bg-white rounded-lg p-6 w-2/3 mx-auto top-1/2">
                            <button class="mb-1 mr-3 bg-red-500 text-white px-4 py-2 rounded"
                                @click.prevent="togglePaymentModal()">X</button>
                            <div class="flex gap-4">
                                <!-- Card 1 -->
                                <div class="border rounded-lg p-6 mx-auto w-1/2">
                                    <h2 class="text-lg font-bold mb-4">Payez au moment de votre séjour</h2>
                                    <ul class="list-disc list-inside mb-4">
                                        <li>Les informations de la carte de crédit ne sont pas nécessaires pour
                                            compléter
                                            cette réservation</li>
                                        <li>Ne payez rien avant de partir</li>
                                        <li>Payez directement sur place dans la devise préférée de l'hébergement (XOF)
                                        </li>
                                    </ul>
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-sm text-gray-500">Hotels.com® Rewards</span>
                                        <span class="text-lg font-semibold">{{ room.price }} €</span>
                                    </div>
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg w-full">Payez au moment
                                        de
                                        votre séjour</button>
                                </div>
                                <!-- Card 2 -->
                                <div class="border rounded-lg p-6 mx-auto w-1/2">
                                    <h2 class="text-lg font-bold mb-4">Payez le total maintenant</h2>
                                    <ul class="list-disc list-inside mb-4">
                                        <li>Votre paiement sera traité dans votre devise locale</li>
                                        <li>Plusieurs moyens de payer : carte de crédit/débit</li>
                                        <li>Vous pouvez utiliser un bon promo Hotels.com valide</li>
                                    </ul>
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-sm text-gray-500">Hotels.com® Rewards</span>
                                        <span class="text-lg font-semibold">{{ room.price }} €</span>
                                    </div>
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg w-full">Payer
                                        maintenant</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-8">
            <h3 id="condition" class="font-bold">Conditions</h3>
            <ul class="ml-5">
                <li class="" v-for="key in conditions" :key="key.id">
                    <h4 class="font-semibold">{{ key.title }}</h4>
                    <div class="mb-2">
                        {{ key.content }}
                    </div>
                </li>
            </ul>
        </div>

        <div>
            <h3 class="font-bold">Foire aux questions</h3>
            <Accordion :items=faqs />
        </div>
    </main>

    <!-- Footer -->
    <Footer />

</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from "vue-router"

import RoomPersonFilter from '../components/RoomPersonFilter.vue'
import Accordion from '../components/Accordion.vue'
import Footer from '../components/Footer.vue'
import Nav from '../components/Nav.vue'

const isRoomPersonFilterOpen = ref(false)
const isPaymentOpen = ref(false)
const route = useRoute();
let req = route.params.id

let checkInDate = localStorage.getItem('checkInDate')
let checkOutDate = localStorage.getItem('checkOutDate')
let guests = localStorage.getItem('guests')
let rooms = localStorage.getItem('rooms')

const faqs = ref([])
const structure = ref([])
const conditions = ref([])

// carousel
const currentIndex = ref(0)
const next = (obj) => {
    currentIndex.value = (currentIndex.value + 1) % obj.length
}
const prev = (obj) => {
    currentIndex.value = (currentIndex.value - 1 + obj.length) % obj.length
}

const toggleRoomPersonFilter = () => {
    isRoomPersonFilterOpen.value = !isRoomPersonFilterOpen.value
}

const togglePaymentModal = () => {
    isPaymentOpen.value = !isPaymentOpen.value
}

const getData = async () => {
    await axios.get('/api/room-detail/' + req).then((result) => {
        structure.value = result.data.structure
        faqs.value = result.data.faqs
        conditions.value = result.data.conditions
    }).catch((err) => {
    });
}

onMounted(async () => {
    await getData()
})
</script>