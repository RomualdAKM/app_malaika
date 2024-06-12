<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Structure Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your structure's information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('structure.update', [$user->structure->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Dénomination')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->structure->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->structure->email)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Contact')" />
            <x-text-input id="contact" name="contact" type="tel" class="mt-1 block w-full" :value="old('contact', $user->structure->contact)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('contact')" />
        </div>

        <div>
            <x-input-label for="slug" :value="__('Lien')" />
            <x-text-input id="slug" name="slug" type="url" class="mt-1 block w-full" :value="old('slug', $user->structure->slug)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('Ville')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->structure->city)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Adresse')" />
            <x-text-input id="address" name="address" type="address" class="mt-1 block w-full" :value="old('address', $user->structure->address)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description"
                class="p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded shadow-lg mt-1 block w-full"
                cols="30" rows="10">{{ old('description') ?? $user->structure->description }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="latitude" :value="__('Latitude')" />
            <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" :value="old('latitude', $user->structure->latitude)"
                readonly />
            <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
        </div>

        <div>
            <x-input-label for="longitude" :value="__('Longitude')" />
            <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" :value="old('longitude', $user->structure->longitude)"
                readonly />
            <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
        </div>

        <div>
            <x-input-label for="logo" :value="__('Logo')" />
            <x-text-input id="logo" name="logo" type="file" class="mt-1 block w-full" />
            <div class="w-1/2 p-1 md:p-2">
                <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                    src="{{ asset('logos/' . $user->structure->logo) }}" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Modifier') }}</x-primary-button>
        </div>
    </form>

    <div class="mt-8">
        <div class="flex justify-between">
            <h2 class="text-lg font-medium text-gray-900">Galleries hotel</h2>
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-image')">
                Ajouter
            </x-primary-button>

            <x-modal name="add-image" focusable>
                <div class="p-4">
                    <form action="{{ route('gallery.structure.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $user->structure->id }}" name="structure">

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
                        action="{{ route('gallery.structure.destroy', $image->id) }}" method="post">
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
</section>
