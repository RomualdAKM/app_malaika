<template>
    <div>
        <div v-for="(item, index) in items" :key="index"
            class="border border-neutral-200 rounded-md mb-2 text-md">
            <h2 :id="'heading' + index">
                <button
                    class="group relative flex w-full items-center border-0 px-5 py-4 text-left text-base text-neutral-800 transition hover:z-[2] focus:z-[3] focus:outline-none"
                    @click="toggle(index)">
                    {{ item.title }}
                    <span class="ml-auto h-5 w-5 transform transition-transform duration-200 ease-in-out"
                        :class="{ 'rotate-180': isActive(index) }">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </button>
            </h2>
            <div v-if="isActive(index)" class="px-5 py-4">
                <span v-html="item.content"></span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    items: {
        type: Array,
        required: true
    }
})

// Déclarez les propriétés réactives
const activeIndex = ref(null);

// Déclarez les fonctions
const toggle = (index) => {
    activeIndex.value = activeIndex.value === index ? null : index;
};

const isActive = (index) => {
    return activeIndex.value === index;
};
</script>

<style>
.rotate-180 {
    transform: rotate(180deg);
}
</style>