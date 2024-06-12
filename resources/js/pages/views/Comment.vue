<template>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg mx-auto">
        <div class="text-center mb-6">
            <img src="https://www.hotels.com/logo.png" alt="Hotels.com" class="mx-auto">
            <p class="text-lg font-semibold">Merci à l'avance pour vos commentaires.</p>
            <p class="text-sm">Nous ne pouvons pas répondre aux questions via ce formulaire. Veuillez vous rendre sur la
                <a href="#" class="text-blue-600 underline">page de l'assistance clientèle</a> pour obtenir plus d'aide.
            </p>
        </div>

        <form>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Satisfaction globale *</label>
                <div class="flex space-x-2">
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">1★</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">2★</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">3★</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">4★</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">5★</button>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Dans quelle mesure recommanderiez-vous
                    Hotels.com à un ami ou un collègue ? *</label>
                <div class="grid grid-cols-11 gap-2">
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">0</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">1</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">2</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">3</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">4</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">5</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">6</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">7</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">8</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">9</button>
                    <button type="button" class="bg-gray-200 text-gray-800 rounded py-2 px-4">10</button>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Sujet *</label>
                <select class="block w-full bg-gray-200 text-gray-700 py-2 px-3 border border-gray-300 rounded">
                    <option>Choisissez le sujet de vos commentaires...</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Veuillez inclure tout autre renseignement que
                    vous aimeriez nous partager. *</label>
                <textarea class="block w-full bg-gray-200 text-gray-700 py-2 px-3 border border-gray-300 rounded h-24"
                    placeholder="Saisissez vos commentaires ici"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Adresse e-mail *</label>
                <input type="email"
                    class="block w-full bg-gray-200 text-gray-700 py-2 px-3 border border-gray-300 rounded"
                    placeholder="exemple@email.com">
                <p class="text-xs text-gray-600 mt-2">Nous utiliserons votre adresse e-mail uniquement pour effectuer un
                    suivi relatif aux problèmes de compte. Votre adresse ne sera pas utilisée dans un autre contexte.
                </p>
            </div>

            <div class="flex gap-6">
                <button type="button" @click="$router.go(-1)"
                    class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-700">Retour</button>
                <button type="submit"
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Envoyer</button>
            </div>
        </form>
    </div>
</template>