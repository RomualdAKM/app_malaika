<template>
    <div class="mx-auto bg-white p-6 rounded-lg border border-gray-200 text-xs">
        <div class="room-container">
            <div v-for="(room, index) in rooms" :key="index" class="room mb-4">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold">Chambre {{ index + 1 }}</h2>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span>Adultes</span>
                        <div class="flex items-center">
                            <button class="w-5 h-5 flex items-center justify-center border rounded-full"
                                aria-label="Decrease adults" @click="decrementAdults(index)">
                                -
                            </button>
                            <span class="w-4 mx-1 text-center">{{ room.adults }}</span>
                            <button class="w-5 h-5 flex items-center justify-center border rounded-full"
                                aria-label="Increase adults" @click="incrementAdults(index)">
                                +
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Enfants <small class="text-gray-500">(De 0 à 17 ans)</small></span>
                        <div class="flex items-center">
                            <button class="w-5 h-5 flex items-center justify-center border rounded-full"
                                aria-label="Decrease children" @click="decrementChildren(index)">
                                -
                            </button>
                            <span class="w-4 mx-1 text-center">{{ room.children }}</span>
                            <button class="w-5 h-5 flex items-center justify-center border rounded-full"
                                aria-label="Increase children" @click="incrementChildren(index)">
                                +
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 text-blue-600 cursor-pointer">
            <a href="#" class="hover:underline" @click.prevent="addRoom">Ajouter une autre chambre</a>
        </div>
        <button class="w-full py-2 bg-blue-600 text-white rounded-lg" @click="validate">Valider</button>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const rooms = ref([{ adults: 0, children: 0 }])

const addRoom = () => {
    rooms.value.push({ adults: 0, children: 0 })
}

const incrementAdults = (index) => {
    rooms.value[index].adults++
}

const decrementAdults = (index) => {
    if (rooms.value[index].adults > 0) rooms.value[index].adults--
}

const incrementChildren = (index) => {
    rooms.value[index].children++
}

const decrementChildren = (index) => {
    if (rooms.value[index].children > 0) rooms.value[index].children--
}

const validate = () => {
    console.log(rooms.value)
}
</script>
