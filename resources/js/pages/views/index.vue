<template>
    <header
        class="bg-[url('https://www.cogedim.com/sites/default/files/images/Annecy--Osmose---Custhome-FD-optimise.jpg')] bg-cover bg-[50%] bg-no-repeat h-screen min-h-[500px]">
        <!-- Navigation bar -->
        <Nav />

        <!-- Hero section with background image, heading, subheading and button -->
        <div class="relative h-[400px] overflow-hidden">
            <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-fixed z-40">
                <div class="flex h-full items-center justify-center">
                    <div class="px-6 text-center md:px-12">
                        <h1 class="mb-6 text-3xl font-semibold text-white">Trouver un hôtel</h1>

                        <form @submit.prevent="submitForm()">
                            <div
                                class="lg:flex gap-4 md:grid grid-cols-2 bg-white opacity-80 rounded-lg p-4 items-center">
                                <div class="my-2">
                                    <input
                                        class="placeholder:text-indigo-900 text-xs h-8 w-48 p-2 outline-0 text-indigo-900 border-b-2"
                                        type="text" placeholder="Destination" v-model="destination" required>
                                </div>
                                <div class="my-2">
                                    <input
                                        class="placeholder:text-indigo-900 text-xs h-8 w-48 p-2 outline-0 text-indigo-900 border-b-2"
                                        type="date" placeholder="Début du séjour" v-model="checkInDate" >
                                </div>
                                <div class="my-2">
                                    <input
                                        class="placeholder:text-indigo-900 text-xs h-8 w-48 p-2 outline-0 text-indigo-900 border-b-2"
                                        type="date" placeholder="Fin de séjour" v-model="checkOutDate" >
                                </div>
                                <div class="my-2">
                                    <input
                                        class="placeholder:text-indigo-900 text-xs h-8 w-48 p-2 outline-0 text-indigo-900 border-b-2"
                                        type="number" placeholder="Nombre de chambre" v-model="rooms" >
                                </div>
                                <div class="my-2">
                                    <input
                                        class="placeholder:text-indigo-900 text-xs h-8 w-48 p-2 outline-0 text-indigo-900 border-b-2"
                                        type="number" placeholder="Personne par chambre" v-model="guests" >
                                </div>

                                <button type="submit"
                                    class="rounded-full bg-indigo-900 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-300 hover:text-neutral-200 focus:border-neutral-300 focus:text-neutral-200 focus:outline-none focus:ring-0 active:border-neutral-300 active:text-neutral-200"
                                    data-twe-ripple-init data-twe-ripple-color="light">
                                    Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div
        class="bg-purple-800 text-white rounded-lg flex sm:flex-col lg:flex-row items-center w-2/3 mx-auto relative -top-28 lg:-top-14">
        <div class="flex  w-full lg:w-auto items-center justify-between bg-slate-200 p-4 lg:rounded-l-lg rounded-t-lg lg:rounded-tr-none">
            <span class="font-bold text-black">Découvrez</span>
            <img class="w-20 mx-4" src="logos/avis-client.png" alt="avis-client">
        </div>
        <div class="flex-1 text-xs p-4">
            <p class="">Notre logiciel vous permet de créer vos enquêtes facilement,</p>
            <p class="">Ainsi que de les envoyer par SMS ou par Mail,</p>
            <p class="">Et de partager les résultats, et de les exploiter !</p>
            <p class="">Soyez en contact avec des professionnels qui interviennent dans le même domaine que vous.
            </p>
        </div>
        <div class="p-4 flex items-center justify-center">
            <a href="https://avis-client.online/" class="bg-purple-900 text-white font-bold py-2 px-4 rounded-lg">
                Je découvre
            </a>
        </div>
    </div>

    <!-- city list -->
    <section class="m-8" v-if="cities.length != 0">
        <h2 class="text-xl font-semibold text-purple-700 mb-4 text-center">Des hôtels partout au Bénin</h2>
        <div class="flex flex-wrap">
            <div class="w-1/4" v-for="city in cities">
                <span class="inline-block font-semibold">{{ city.city }}</span>
                <span
                    class="ml-4 inline-block whitespace-nowrap rounded-full bg-danger-500 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-semibold leading-none text-white">
                    {{ city.count }}
                </span>
            </div>
        </div>
    </section>

    <!-- a la une -->
    <section class="m-8 p-8 relative overflow-hidden" v-if="cards.length != 0">
        <h2 class="text-xl font-semibold text-purple-700 mb-4 text-center">Hôtels à la Une</h2>
        <button class="absolute left-0 top-1/2 bg-black opacity-50 p-4 text-white border-0 cursor-pointer z-10"
            @click="prev">❮</button>
        <div class="flex flex-nowrap transition ease-in-out delay-500 gap-3">
            <div v-for="(card, index) in cards.slice(cardIndex, cardIndex + 3)" :key="index"
                class="rounded-lg bg-white shadow-secondary-1 flex-initial w-1/3 transition ease-in-out delay-500">
                <img class="rounded-t-lg" :src="`photos/${card.images[0].path}`" :alt="`${card.images[0].path}`" />
                <div class="p-6 text-surface">
                    <h5 class="mb-2 text-xl font-medium leading-tight">{{ card.name }}</h5>
                    <p class="mb-4 text-base">{{ card.description }}</p>
                    <router-link :to="{ name: 'room-detail', params: { id: card.id } }"
                        class="inline-block rounded bg-blue-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 w-full text-center"
                        data-twe-ripple-init data-twe-ripple-color="light">
                        Voir Plus
                    </router-link>
                </div>
            </div>
        </div>
        <button class="absolute right-0 top-1/2 bg-black opacity-50 p-4 text-white border-0 cursor-pointer z-10"
            @click="next">❯</button>
    </section>

    <!-- testimonies -->
    <section class="py-16" v-if="testimonies.length != 0">
        <div class="container mx-auto px-4 relative">
            <h2 class="text-xl font-semibold text-purple-700 mb-4 text-center">Des clients satisfaits</h2>
            <button class="absolute left-0 top-1/2 bg-black opacity-50 p-4 text-white border-0 cursor-pointer z-10"
                @click="nextTestimony">❮</button>
            <div class="flex justify-center space-x-4">
                <div v-for="(testimony, index) in testimonies.slice(testimonyIndex, testimonyIndex + 2)" :key="index"
                    class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                    <h3 class="text-xl font-semibold mb-2">{{ testimony.title }}</h3>
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.324 4.084a1 1 0 00.95.69h4.29c.969 0 1.371 1.24.588 1.81l-3.486 2.533a1 1 0 00-.364 1.118l1.323 4.084c.3.921-.755 1.688-1.54 1.118l-3.486-2.533a1 1 0 00-1.175 0l-3.486 2.533c-.785.57-1.84-.197-1.54-1.118l1.323-4.084a1 1 0 00-.364-1.118L2.193 9.51c-.784-.57-.38-1.81.588-1.81h4.29a1 1 0 00.95-.69l1.324-4.084z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.324 4.084a1 1 0 00.95.69h4.29c.969 0 1.371 1.24.588 1.81l-3.486 2.533a1 1 0 00-.364 1.118l1.323 4.084c.3.921-.755 1.688-1.54 1.118l-3.486-2.533a1 1 0 00-1.175 0l-3.486 2.533c-.785.57-1.84-.197-1.54-1.118l1.323-4.084a1 1 0 00-.364-1.118L2.193 9.51c-.784-.57-.38-1.81.588-1.81h4.29a1 1 0 00.95-.69l1.324-4.084z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.324 4.084a1 1 0 00.95.69h4.29c.969 0 1.371 1.24.588 1.81l-3.486 2.533a1 1 0 00-.364 1.118l1.323 4.084c.3.921-.755 1.688-1.54 1.118l-3.486-2.533a1 1 0 00-1.175 0l-3.486 2.533c-.785.57-1.84-.197-1.54-1.118l1.323-4.084a1 1 0 00-.364-1.118L2.193 9.51c-.784-.57-.38-1.81.588-1.81h4.29a1 1 0 00.95-.69l1.324-4.084z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.324 4.084a1 1 0 00.95.69h4.29c.969 0 1.371 1.24.588 1.81l-3.486 2.533a1 1 0 00-.364 1.118l1.323 4.084c.3.921-.755 1.688-1.54 1.118l-3.486-2.533a1 1 0 00-1.175 0l-3.486 2.533c-.785.57-1.84-.197-1.54-1.118l1.323-4.084a1 1 0 00-.364-1.118L2.193 9.51c-.784-.57-.38-1.81.588-1.81h4.29a1 1 0 00.95-.69l1.324-4.084z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.324 4.084a1 1 0 00.95.69h4.29c.969 0 1.371 1.24.588 1.81l-3.486 2.533a1 1 0 00-.364 1.118l1.323 4.084c.3.921-.755 1.688-1.54 1.118l-3.486-2.533a1 1 0 00-1.175 0l-3.486 2.533c-.785.57-1.84-.197-1.54-1.118l1.323-4.084a1 1 0 00-.364-1.118L2.193 9.51c-.784-.57-.38-1.81.588-1.81h4.29a1 1 0 00.95-.69l1.324-4.084z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 mb-4">{{ testimony.content }}</p>
                    <p class="text-gray-500 text-sm">Publié le {{ testimony.date }}<br>{{ testimony.author }}</p>
                </div>
                <button class="absolute right-0 top-1/2 bg-black opacity-50 p-4 text-white border-0 cursor-pointer z-10"
                    @click="prevTestimony">❯</button>
            </div>
        </div>
    </section>

    <section class="py-16" v-if="faqs.length != 0">
        <div class="container mx-auto px-4">
            <h2 class="text-xl font-semibold text-purple-700 mb-4 text-center">
                Toutes nos réponses <span class="text-pink-600">à
                    vos questions</span>
            </h2>
            <div class="flex items-center mb-8 justify-center">
                <input type="text" placeholder="Mot-clé ou question" class="border rounded-full py-2 px-4 mr-2">
                <button class="bg-pink-600 text-white rounded-full py-2 px-6">Rechercher</button>
            </div>
            <div class="md:w-1/2 mx-auto">
                <Accordion :items=faqs />
            </div>
            <div class="mt-4 py-4 text-center">
                <a href="/faqs" class="text-purple-600 underline">Voir toutes les FAQ</a>
            </div>
        </div>
    </section>

    <section>
        <Footer />
    </section>

</template>

<script setup>
import { onMounted, ref } from 'vue'

import Accordion from '../components/Accordion.vue'
import Footer from '../components/Footer.vue'
import router from '../../router/index.js'
import Nav from '../components/Nav.vue'

const destination = ref('')
const checkInDate = ref('')
const checkOutDate = ref('')
const testimonies = ref([])
const rooms = ref('')
const guests = ref('')
const cities = ref([])
const faqs = ref([])
const cards = ref([])

const cardIndex = ref(0)
const testimonyIndex = ref(0)

function next() {
    if (cardIndex.value < cards.value.length - 3) {
        cardIndex.value += 3
    }
}

function prev() {
    if (cardIndex.value > 0) {
        cardIndex.value -= 3
    }
}

function nextTestimony() {
    if (testimonyIndex.value < testimonies.value.length - 2) {
        testimonyIndex.value += 2
    }
}

function prevTestimony() {
    if (testimonyIndex.value > 0) {
        testimonyIndex.value -= 2
    }
}

function submitForm() {
    router.push({
        name: 'Results',
        query: {
            destination: destination.value,
            checkInDate: checkInDate.value,
            checkOutDate: checkOutDate.value,
            guests: guests.value,
            rooms: rooms.value,
        }
    });
}

const getCities = async () => {
    await axios.get('api/app').then((result) => {
        faqs.value = result.data.faqs
        cities.value = result.data.cities
        cards.value = result.data.structures
        testimonies.value = result.data.testimonies
    }).catch((err) => {
    });
}

onMounted(async () => {
    await getCities()
    console.log(cards)
})
</script>