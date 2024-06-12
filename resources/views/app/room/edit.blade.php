<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded">
                <div class="p-6 text-gray-900">
                    <h1 class="text-lg font-medium text-gray-900">Modifier les informations de {{ $room->name }}</h1>
                    <x-forms.update :item="$room" :fields="$my_fields" type="room" />

                    <div class="mt-8">
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900">Galleries</h2>
                            <x-primary-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'add-image')">
                                Ajouter
                            </x-primary-button>

                            <x-modal name="add-image" focusable>
                                <div class="p-4">
                                    <form action="{{ route('gallery.room.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $room->id }}" name="room">

                                        <x-input-label for="photos">Ajouter des photos</x-input-label>
                                        <input id="photos" class="block mt-1 w-full border-2 p-2 rounded outline-0"
                                            type="file" name="photo[]" multiple required accept="image/*">
                                        <div class="flex items-center justify-start mt-6">
                                            <x-primary-button>
                                                {{ __('Ajouter') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </x-modal>
                        </div>
                        <div class="flex gap-4 mt-4">
                            @foreach ($photos as $image)
                                <div class="flex justify-end" x-data="{ isHovered: false }" @mouseenter="isHovered = true"
                                    @mouseleave="isHovered = false">
                                    <form class="bg-gray-200 absolute z-50 rounded"
                                        action="{{ route('gallery.room.destroy', $image->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button x-show="isHovered" type="submit" class="text-red-500 p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>

                                    <img src="{{ asset('photos/' . $image->path) }}" alt="{{ $image->path }}"
                                        class="z-0 w-48 h-48 object-cover rounded">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
