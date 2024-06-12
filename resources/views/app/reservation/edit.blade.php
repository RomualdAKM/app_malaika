<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded">
                <div class="p-6 text-gray-900">
                    <h1>Modifier le statut de la réservation</h1>
                    <x-forms.update :item="$reservation" :fields="$my_fields" type="reservation" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
