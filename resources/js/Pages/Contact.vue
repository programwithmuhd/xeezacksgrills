<script setup>
import { Head, Link } from '@inertiajs/vue3';
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';
import Slider from "@/Pages/Slider.vue";


</script>

<template>
    <Head title="About" />

    <XeezacksgrillLayout>
        <div class="w-full grid place-items-center bg-black opacity-80 h-60">
            <div class="max-w-7xl mx-auto">
                <div class="text-5xl text-gray-200 text-center mb-8">Contact Us</div>
                <div class="text-lg text-gray-200 text-center">serving the city of kaduna and locations around it!</div>
            </div>
        </div>
        <div class="w-full bg-white h-auto">
            <div class="bg-white">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-lg text-gray-900 font-semibold text-center px-16 py-12">Our Location</h2>
                    <h1 class="text-4xl text-black font-black text-center p-1">#1 Rimi Drive</h1>
                    <h1 class="text-4xl text-black font-black text-center p-1">Unguwar Rimi Kaduna</h1>
                    <p class="text-lg text-gray-900 py-8 text-center">Welcome to our restaurant!</p>
                    <div class="flex items-center justify-center py-4 mb-4">
                        <Link :href="route('reservation.index')" class="inline-flex items-center px-8 py-2 
                                            bg-green-600 border border-transparent 
                                            rounded-md font-semibold text-lg text-white 
                                            uppercase tracking-widest 
                                            hover:bg-green-500 active:bg-bg-yellow-600 
                                            focus:outline-none focus:ring-2 
                                            focus:ring-bg-green-500 focus:ring-offset-2 
                                            transition ease-in-out duration-150
                                        ">Book Table
                        </Link>
                    </div>
                    <div class="mt-6">
                        <div class="text-xl font-medium text-gray-900 text-center">Call Us For Reservations!</div>
                        <div class="md:text-5xl text-3xl font-bold text-gray-900 text-center py-4">07038989839</div>
                    </div>
                </div>
            </div>        
        </div>
    </XeezacksgrillLayout>
</template>