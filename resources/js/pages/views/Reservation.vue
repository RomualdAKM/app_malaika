<template>
    <header>
        <div class="bg-white shadow p-4 text-sm text-gray-500 text-center">
            <p>Tarif non remboursable</p>
            <p>Si vous annulez ou modifiez votre réservation, vous ne serez pas remboursé.</p>
        </div>

        <div class="shadow-lg">
            <Nav />
        </div>
    </header>
    <main class="container mx-auto p-4">
        <div class="bg-white p-6">
            <div class="flex items-center justify-between" v-if="room.structure">
                <h1 class="text-2xl font-bold mb-4">Hôtel {{ room.structure.name }}</h1>
                <a href="/comment">
                    <button class="bg-red-500 text-white p-4 text-xs">Laissez un commentaire</button>
                </a>
            </div>

            <form>
                <div class="mt-4 mb-6 space-y-4">
                    <h2 class="text-xl font-semibold mb-2">Étape 1 : Vos coordonnées</h2>
                    <div class="lg:w-1/2">
                        <label class="block">Prénom*</label>
                        <input type="text" class="w-full border rounded p-2" v-model="reqs.firstname" required>
                    </div>
                    <div class="lg:w-1/2">
                        <label class="block">Nom*</label>
                        <input type="text" class="w-full border rounded p-2" v-model="reqs.name" required>
                    </div>
                    <div class="lg:w-1/2">
                        <label class="block">Adresse e-mail*</label>
                        <input type="email" class="w-full border rounded p-2" v-model="reqs.email" required>
                    </div>
                    <div class="lg:w-1/2">
                        <label class="block">Numéro de mobile*</label>
                        <input type="tel" class="w-full border rounded p-2" v-model="reqs.contact" required>
                    </div>
                    <div class="lg:w-1/2">
                        <input type="checkbox" class="mr-2" v-model="newsletter">
                        <label class="">Je ne souhaite pas recevoir de newsletters</label>
                    </div>
                </div>

                <div class="mt-4 mb-6 space-y-4" v-if="room">
                    <h2 class="text-xl font-semibold mb-2">Étape 2 : Informations sur l'hébergement</h2>
                    <div class="space-y-4">
                        <h3 class="font-semibold">Points forts</h3>
                        <div class="flex items-start gap-4">
                          
                            <p>Wi-Fi gratuit</p>
                            <p>Piscine</p>
                            <p>Petit-déjeuner</p>
                        </div>
                        <div class="border rounded p-4">
                            <p class="text-sm font-semibold">{{ room.name }}</p>
                            <p class="text-sm">Compris dans votre chambre :</p>
                            <ul class="list-disc list-inside" v-for="equipment in room.equipment" :key="equipment.id">
                                <li>{{ equipment.name }}</li>
                                <!-- <li>Wi-Fi gratuit</li> -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-6 space-y-4">
                    <h2 class="text-xl font-semibold mb-2">Étape 3 : Détails de paiement</h2>
                    <!-- <form class="space-y-4">
                        <div>
                            <input type="radio" name="payment" class="mr-2">
                            <label>Carte</label>
                        </div>
                        <div>
                            <input type="radio" name="payment" class="mr-2">
                            <label>PayPal</label>
                        </div>
                        <div>
                            <label class="block">Prénom*</label>
                            <input type="text" class="w-full border rounded p-2" required>
                        </div>
                        <div>
                            <label class="block">Nom*</label>
                            <input type="text" class="w-full border rounded p-2" required>
                        </div>
                        <div>
                            <label class="block">Numéro de carte*</label>
                            <input type="text" class="w-full border rounded p-2" required>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block">Date d'expiration*</label>
                                <input type="text" class="w-full border rounded p-2" required>
                            </div>
                            <div>
                                <label class="block">Cryptogramme*</label>
                                <input type="text" class="w-full border rounded p-2" required>
                            </div>
                        </div>
                    </form> -->
                </div>

                <div class="mt-4 mb-6 space-y-4">
                    <h2 class="text-xl font-semibold mb-2">Conditions</h2>
                    <p class="text-sm">Tarif non remboursable</p>
                    <p class="text-sm">Cet hébergement autorise votre transfert depuis l'aéroport...</p>
                </div>

                <div class="flex justify-between items-center">
                    <p class="">Vous y êtes presque ! C'est la dernière étape</p>
                    <button @click="setData()" type="button"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg">Envoyer la demande</button>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup>
import { ref,onMounted } from 'vue'
import Nav from '../components/Nav.vue'
import { useRoute } from "vue-router"

const route = useRoute();

const room = ref({})

const reqs = ref({
    id: route.params.id,
    firstname: '',
    name: '',
    email: '',
    contact: '',
    rooms: localStorage.getItem('rooms'),
    guests: localStorage.getItem('guests'),
    checkInDate: localStorage.getItem('checkInDate'),
    checkOutDate: localStorage.getItem('checkOutDate'),
})

const setData = () => {
    axios.post('/api/reservation-store', reqs.value).then((result) => {
        console.log(result.data)
    }).catch((err) => {
    });
}

const getStructureRoomInfo = async () => {

    await axios.get('/api/get_structure_room/'+ route.params.id).then((result) => {

        room.value = result.data

        console.log('room', room.value)
    }).catch((err) => {
        console.log(err)
    });
}

onMounted ( async () => {

    await getStructureRoomInfo()
})

</script>