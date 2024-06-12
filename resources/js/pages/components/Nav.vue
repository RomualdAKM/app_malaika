<template>
    <nav class="relative flex w-full items-center justify-between py-2 lg:flex-wrap lg:justify-start lg:py-4"
        data-twe-navbar-ref>
        <div class="flex w-full flex-wrap items-center justify-between px-3">
            <img class="w-40" src="logos/logo.png" alt="malaiqua.com">
            <div class="flex items-center">
                <!-- Hamburger menu button -->
                <button
                    class="border-0 bg-transparent px-2 text-xl leading-none transition-shadow duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 motion-reduce:transition-none lg:hidden"
                    type="button" data-twe-collapse-init data-twe-target="#navbarSupportedContentX"
                    aria-controls="navbarSupportedContentX" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- Hamburger menu icon -->
                    <span class="[&>svg]:h-7 [&>svg]:w-7 [&>svg]:stroke-black/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Navigation links -->
            <div class="!visible hidden grow basis-[100%] items-center text-center lg:!flex lg:basis-auto lg:text-left text-indigo-900 font-semibold"
                id="navbarSupportedContentX" data-twe-collapse-item>
                <ul class="me-auto flex flex-col lg:flex-row justify-end w-full" data-twe-navbar-nav-ref>
                    <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
                        <a class="flex lg:px-2" href="/" data-twe-nav-link-ref data-twe-ripple-init
                            data-twe-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg> &nbsp;
                            Trouver un hôtel
                        </a>
                    </li>
                    <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
                        <a class="flex lg:px-2" href="#!" data-twe-nav-link-ref data-twe-ripple-init
                            data-twe-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg> &nbsp;
                            Nos Partenaires
                        </a>
                    </li>
                    <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
                        <a class="flex lg:px-2" href="/faqs" data-twe-nav-link-ref data-twe-ripple-init
                            data-twe-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg> &nbsp;
                            FAQ
                        </a>
                    </li>
                    <li class="mb-2 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
                        <a class="flex lg:px-2" href="#!" data-twe-nav-link-ref data-twe-ripple-init
                            data-twe-ripple-color="light" @click.prevent="toggleContact()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg> &nbsp;
                            Contact
                        </a>

                        <div class="w-full h-full fixed inset-0 flex items-center justify-center z-50" v-if="isContactOpen">
                            <div class="bg-gray-700 opacity-80 absolute w-full h-full z-40" @click.prevent="toggleContact()"></div>
                            <div class="bg-gray-200 p-6 m-4 rounded-lg border border-gray-200 text-xs z-50">
                                <div class="p-6 flex">
                                    <div class="flex-1 text-center border-r border-gray-200 pr-6">
                                        <h2 class="font-semibold text-purple-700">Vous avez un projet voyage ?
                                        </h2>
                                        <div class="mt-4 font-bold text-purple-700"> +33 780 783 727 / +229 55 69 56 56</div>
                                        <div class="text-gray-600">APPEL NON SURTAXÉ</div>
                                        <div class="mt-2 text-gray-500">
                                           +33 780 783 727 / +229 55 69 56 56<br>
                                            7J/7 Lun - Vend de 8h30 à 20h<br>
                                            Sam - Dim de 10h à 18h
                                        </div>
                                        <button class="mt-4 bg-purple-700 text-white py-2 px-4 rounded-full">Poser une
                                            question</button>
                                        <button class="mt-2 bg-purple-700 text-white py-2 px-4 rounded-full">Être appelé
                                            par
                                            un
                                            conseiller</button>
                                    </div>
                                    <div class="flex-1 text-center pl-6">
                                        <h2 class="font-semibold text-purple-700">Vous êtes déjà client ?</h2>
                                        <div class="mt-4 font-bold text-purple-700"> +33 780 783 727 / +229 55 69 56 56</div>
                                        <div class="text-sm text-gray-600">APPEL NON SURTAXÉ</div>
                                        <div class="mt-2 text-gray-500">
                                            +33 780 783 727 / +229 55 69 56 56 depuis l'étranger<br>
                                            Du lundi au vendredi de 9h30 à 12h30<br>
                                            et de 14h à 18h
                                        </div>
                                        <p class="mt-4 text-gray-500">
                                            Vous pouvez également nous écrire sur l'adresse :
                                            <a href="mailto:contact@mylikeart.com"
                                                class="text-purple-700 underline">contact@mylikeart.com</a>
                                        </p>
                                        <p class="mt-2 text-gray-500">
                                            Nos équipes sont mobilisées pour vous répondre dans les meilleurs délais.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-2 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
                        <a class="flex lg:px-2" href="#!" data-twe-nav-link-ref data-twe-ripple-init
                            data-twe-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                            </svg> &nbsp;
                            Support Technique
                        </a>
                    </li>
                    <li class="mb-2 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
                        <a class="flex lg:px-2" href="/dashboard" data-twe-nav-link-ref data-twe-ripple-init
                            data-twe-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg> &nbsp;
                            Se connecter
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<script setup>
import { ref } from 'vue'

const isContactOpen = ref(false)

function toggleContact() {
    isContactOpen.value = !isContactOpen.value
}
</script>