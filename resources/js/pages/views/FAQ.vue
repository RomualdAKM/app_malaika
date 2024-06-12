<template>
    <div class="bg-slate-100">
        <div
            class="bg-[url('https://www.cogedim.com/sites/default/files/images/Annecy--Osmose---Custhome-FD-optimise.jpg')] bg-cover bg-[50%] bg-no-repeat h-96 lg:min-h-screen">
            <!-- Navigation bar -->
            <Nav />
        </div>

        <!-- Main Content -->
        <main class="container mx-auto my-8 px-6 py-8 bg-white rounded-md relative -top-96 -mb-64">
            <div class="md:w-2/3 mx-auto">
                <h1 class="text-center text-3xl font-light mb-4">Toutes les réponses à vos questions</h1>
            <div class="text-center mb-8">
                <input type="text" placeholder="Mot-clé ou question"
                    class="border border-gray-300 rounded-md px-4 py-2 w-full max-w-lg">
                <p class="text-gray-600 mt-4">Vous n'avez pas trouvé votre question ? Contactez-nous via <a
                        href="mailto:service-client@cogedim.com" class="text-purple-700">contact@malaiqua.com</a> pour
                    poser votre question. Nous vous répondrons sous 24 h ouvrées.</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-md">
                <h2 class="text-xl font-bold mb-4">Questions les plus fréquentes</h2>
                <div class="space-y-2">
                    <Accordion :items=faqs />
                </div>
            </div>
            </div>
        </main>

        <Footer />
    </div>

</template>

<script setup>
import { onMounted, ref } from 'vue'
import Accordion from '../components/Accordion.vue'
import Footer from '../components/Footer.vue'
import Nav from '../components/Nav.vue'

const faqs = ref([])

const getFaqs = async () => {
    await axios.get('api/faqs').then((result) => {
        faqs.value = result.data.faqs
    }).catch((err) => {
    });
}

onMounted(async () => {
    await getFaqs()
})
</script>