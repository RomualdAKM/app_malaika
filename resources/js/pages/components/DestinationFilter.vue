<template>
    <div class="mx-auto bg-white p-6 rounded-lg border border-gray-200 text-xs">
        <div class="max-w-md mx-auto mt-10">
            <h2 class="text-2xl font-bold mb-4">Destination</h2>
            <input type="text" v-model="searchQuery" placeholder="Rechercher une destination"
                class="mb-4 p-2 border rounded w-full" />
            <div>
                <h3 class="font-semibold mb-2">Destinations populaires</h3>
                <ul>
                    <li v-for="destination in filteredDestinations" :key="destination.name"
                        class="mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2C8.14 2 5 5.14 5 9c0 7.09 7 13 7 13s7-5.91 7-13c0-3.86-3.14-7-7-7z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">{{ destination.name }}</div>
                            <div class="text-sm text-gray-500">{{ destination.location }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const searchQuery = ref('');
const destinations = ref([
    { name: 'Paris', location: 'France' },
    { name: 'Abidjan', location: "Côte d'Ivoire" },
    { name: 'Istanbul', location: 'Turquie' },
]);

const filteredDestinations = computed(() => {
    return destinations.value.filter(destination =>
        destination.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

</script>