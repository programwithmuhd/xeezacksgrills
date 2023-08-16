<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';
import Slider from "@/Pages/Slider.vue";
import TeaIcon from 'vue-material-design-icons/Tea.vue';
import GrillIcon from 'vue-material-design-icons/Grill.vue';
import FishIcon from 'vue-material-design-icons/Fish.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';

</script>

<template>
    <Head title="Welcome" />

    <XeezacksgrillLayout>
        <Slider />
        <div class="w-full max-w-[7xl] bg-white mx-auto">
            <div class="flex flex-col items-center lg:flex-row justify-between gap-10">
                <div id="left-section" class="w-full p-16 lg:w-5/12">
                    <div class="">
                        <h2 class="md:text-5xl text-3xl font-black text-gray-900 leading-tight">
                            Discover the Good Atmosphere of Xeezacks
                        Grill House</h2>
                    </div>

                    <div class="py-4 text-lg text-gray-900">At Xeezacks Grill House, we are passionate about delivering a dining experience that transcends mere sustenance. Our mission is to ignite your taste buds with the sizzling symphony of perfectly grilled beef, the oceanic delight of succulent fish, and the comforting warmth of rejuvenating tea.</div>
                    <div class="py-4 text-lg text-gray-900">The best turkish grill in kaduna state is here.</div>

                    <div class="aspect-w-9 aspect-h-5">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/g-cPBUoBRjI"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="py-4 text-xl font-bold text-gray-900">Good vibes</div>
                    <div class="py-4 text-lg text-gray-900">We are proud to serve you one of the healthiest and most
                        well-balanced Turkish and Mediterranean Halal food in the heart of kaduna city</div>
                    <div>
                        <img src="/images/logos/dish-1-.png" alt="">
                    </div>
                    </div>
                <div id="right-section" class="w-full p-16 lg:w-5/12">
                    <div class="">
                        <img class="" src="/images/pages/whatsapp-image.jpeg" alt="">
                    </div>

                    <div class="py-2 text-xl font-bold text-gray-900">Cozy place</div>

                    <div class="py-2 text-lg text-gray-900">We are proud to serve you one of the healthiest and most
                        well-balanced Turkish and Mediterranean Halal food in the heart of kaduna city
                    </div>

                    <div class="pt-8">
                        <img src="/images/pages/whatsapp-image2.jpeg" alt="">
                    </div>

                    <div class="py-2 text-xl font-bold text-gray-900">Relax atmosphere</div>
                    <div class="text-lg text-gray-900">We are proud to serve you one of the healthiest and most
                        well-balanced Turkish and Mediterranean Halal food in the heart of kaduna city
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full py-8 bg-[#EDD2877D] px-6">
            <div class="text-center text-4xl font-bold text-gray-900 py-4">
                Our Favorites
            </div>
            <div class="max-w-7xl mx-auto flex flex-col flex-auto items-center lg:flex-row justify-between py-6 px-6 gap-10">
                <TeaIcon size="180"/>
                <GrillIcon size="180"/>
                <FishIcon size="180"/>
            </div>
            <div class="max-w-7xl mx-auto">
                        
                        <p class="text-2xl text-gray-900 leading-8">
                            We source the finest ingredients to ensure that every dish tells a story of flavor and freshness. Our beef is handpicked for its marbling and tenderness, guaranteeing a melt-in-your-mouth experience. The fish we select comes from sustainable sources, reflecting our commitment to the environment and responsible consumption. And our teas? They're carefully curated to whisk you away on a journey of tranquility with each soothing sip.
                        </p>
                    </div>

            <div class="flex items-center justify-center mt-20">
                <Link :href="route('menus.index')" class="inline-flex items-center px-8 py-2 
                                        bg-black border border-transparent 
                                        rounded-md font-semibold text-lg text-white 
                                        uppercase tracking-widest 
                                        hover:bg-bg-black active:bg-bg-black 
                                        focus:outline-none focus:ring-2 
                                        focus:ring-bg-black focus:ring-offset-2 
                                        transition ease-in-out duration-150
                                    ">View More</Link>
            </div>
        </div>

        <div class="w-full mx-auto bg-white">
            <div class="max-w-5xl mx-auto px-6">
                <div class="md:text-5xl text-3xl font-bold text-gray-900 text-center py-4">Reservation</div>
                <div class="text-lg text-gray-900 text-center py-4">Please reserve your table to enable us serve you better!
                </div>
                <div class="max-w-xl text-lg text-gray-900 mx-auto text-center">
                    Come savor the symphony of flavors at Xeezacks Grill House. Join us as we embark on a culinary expedition, where the harmony of grilled beef, fish, and tea creates a symphony for your senses.
                </div>
                <div class="flex items-center justify-center py-4">
                <Link :href="route('reservation.index')" class="inline-flex items-center px-8 py-2 
                                        bg-green-600 border border-transparent 
                                        rounded-md font-semibold text-lg text-white 
                                        uppercase tracking-widest 
                                        hover:bg-green-500 active:bg-bg-yellow-600 
                                        focus:outline-none focus:ring-2 
                                        focus:ring-bg-green-500 focus:ring-offset-2 
                                        transition ease-in-out duration-150
                                    ">Book Table</Link>
            </div>
                <div class="mt-10">
                    <div class="text-xl font-medium text-gray-900 text-center">Call Us For Reservations!</div>
                    <div class="md:text-5xl text-3xl font-bold text-gray-900 text-center py-4">07038989839</div>
                </div>
            </div>
        </div>
    </XeezacksgrillLayout></template>