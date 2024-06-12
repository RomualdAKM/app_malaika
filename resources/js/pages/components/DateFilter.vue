<template>
    <div class="mx-auto bg-white p-6 rounded-lg border border-gray-200 text-xs">
        <div class="flex justify-between items-center mb-4">
            <div class="flex flex-col">
                <label class="text-xs">Début</label>
                <input v-model="startDate" type="date" class="border p-2 rounded" />
            </div>
            <span class="mx-2">-</span>
            <div class="flex flex-col">
                <label class="text-xs">Fin</label>
                <input v-model="endDate" type="date" class="border p-2 rounded" />
            </div>
        </div>

        <div class="flex justify-between items-center mb-4">
            <button @click="adjustDateRange(-1)" class="px-2 py-1 bg-blue-500 text-white rounded">± 1 jour</button>
            <button @click="adjustDateRange(-2)" class="px-2 py-1 bg-blue-500 text-white rounded">± 2 jours</button>
            <button @click="adjustDateRange(-3)" class="px-2 py-1 bg-blue-500 text-white rounded">± 3 jours</button>
            <button @click="adjustDateRange(-7)" class="px-2 py-1 bg-blue-500 text-white rounded">± 7 jours</button>
        </div>
        <button @click="submit" class="w-full py-2 bg-blue-600 text-white rounded-lg">Valider</button>

    </div>
</template>

<script setup>
import { ref } from 'vue'

const startDate = ref('')
const endDate = ref('')

const adjustDateRange = (days) => {
    if (startDate.value && endDate.value) {
        const start = new Date(startDate.value)
        const end = new Date(endDate.value)
        start.setDate(start.getDate() + days)
        end.setDate(end.getDate() + days)
        startDate.value = start.toISOString().split('T')[0]
        endDate.value = end.toISOString().split('T')[0]
    }
}

const submit = () => {
    console.log('Start Date:', startDate.value)
    console.log('End Date:', endDate.value)
}
</script>