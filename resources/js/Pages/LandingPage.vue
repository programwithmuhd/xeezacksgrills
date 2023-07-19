<script setup>
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';
import Slider from "@/Pages/Slider.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    grilled_meat: null,
    grilled_chicken: null,
    tea_cups: null,
    comments: '',
});

const submit = () => {
    form.post(route('landing-page.store'));
};

</script>

<template>
    <Head title="Welcome" />

    <XeezacksgrillLayout>
        <Slider />
        <div class="w-full bg-white">
            <div class="max-w-7xl mx-auto flex flex-col items-center lg:flex-row justify-between gap-40">
                <div class="py-4 sm:5-1/12 px-4 lg:w-5/12">
                    <h2 class="text-5xl font-medium text-gray-900 leading-none">Discover the Good Atmosphere of Xeezacks
                        Grill House</h2>
                    <div class="py-4 text-lg text-gray-900">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Impedit ipsam nemo vitae exercitationem laudantium? Ipsum.</div>
                    <div class="py-4 text-lg text-gray-900">The best turkish grill in kaduna state is here.</div>

                    <div class="aspect-w-9 aspect-h-5">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/g-cPBUoBRjI"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>

                    <div class="py-4 text-xl font-bold text-gray-900">Good vibes</div>
                    <div class="py-4 text-lg text-gray-900">We are proud to serve you one of the healthiest and most
                        well-balanced Turkish and Mediterranean Halal food in the heart of kaduna city</div>
                    <div>
                        <img src="/images/logos/dish-1-.png" alt="">
                    </div>
                </div>
                <div class="mt-24 py-4 sm:5-1/12 px-4 lg:w-5/12">
                    <div class="mt-2">
                        <img src="/images/pages/whatsapp-image.jpeg" alt="">
                    </div>
                    <div class="py-2 text-xl font-bold text-gray-900">Cozy place</div>
                    <div class="py-2 text-lg text-gray-900">We are proud to serve you one of the healthiest and most
                        well-balanced Turkish and Mediterranean Halal food in the heart of kaduna city</div>

                    <div class="pt-8">
                        <img src="/images/pages/whatsapp-image2.jpeg" alt="">
                    </div>
                    <div class="py-2 text-xl font-bold text-gray-900">Relax atmosphere</div>
                    <div class="text-lg text-gray-900">We are proud to serve you one of the healthiest and most
                        well-balanced Turkish and Mediterranean Halal food in the heart of kaduna city</div>

                </div>
            </div>
        </div>
        <div class="w-full py-8 bg-[#EDD2877D] px-6">
            <div class="text-center text-2xl font-bold text-gray-900 py-4">
                Our Menus
            </div>
            <div class="flex flex-col flex-auto items-center lg:flex-row justify-between py-4 px-6">
                <div class="hidden lg:block h-1 bg-black w-4/12 ml-44"></div>
                <div class="text-5xl text-center w-4/12 px-2">Delicious Lunch Special</div>
                <div class="hidden lg:block h-1 bg-black w-4/12 mr-44"></div>
                <div class="text-xl text-center"></div>
            </div>
            <div class="max-w-2xl mx-auto">
                <div class="text-xl text-center text-gray-900">
                    Free Soda or Bottle Water with any Sandwich Served With Lettuce, Tomatoes, Onions, Home Made White and
                    Hot Sauce All Sandwiches are made fresh upon order for our valued customers <br>11am – 4pm
                </div>
            </div>

            <div class="max-w-7xl mx-auto py-8">
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-10 px-6">
                    <div class="border-b border-black py-1">
                        LAMB DONER/GYRO OR CHICKEN DONER /GYRO WITH PITA BREAD - $10.50
                    </div>
                    <div class="border-b border-black py-1">
                        FALAFEL VEGETARIAN SERVED WITH HUMMUS WITH PITA BREAD - $9.50
                    </div>
                    <div class="border-b border-black py-1">
                        LAMB DONER/GYRO OR CHICKEN DONER /GYRO WITH PITA BREAD - $10.50
                    </div>
                    <div class="border-b border-black py-1">
                        FALAFEL VEGETARIAN SERVED WITH HUMMUS WITH PITA BREAD - $9.50
                    </div>
                    <div class="border-b border-black py-1">
                        LAMB DONER/GYRO OR CHICKEN DONER /GYRO WITH PITA BREAD - $10.50
                    </div>
                    <div class="border-b border-black py-1">
                        FALAFEL VEGETARIAN SERVED WITH HUMMUS WITH PITA BREAD - $9.50
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto flex flex-col flex-auto items-center lg:flex-row justify-between py-4">
                <div class="hidden lg:block h-1 bg-black w-4/12 mx-6"></div>
                <div class="text-5xl text-center w-4/12">
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-black hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">View
                        more</button>
                </div>
                <div class="hidden lg:block h-1 bg-black w-4/12 mx-6"></div>
            </div>
        </div>

        <div class="w-full mx-auto bg-white">
            <div class="max-w-5xl mx-auto px-6">
                <div class="text-5xl font-bold text-gray-900 text-center py-4">Reservation</div>
                <div class="text-lg text-gray-900 text-center py-4">Please reserve your table to enable us serve you better!
                </div>
                <div class="max-w-xl mx-auto mb-8">
                    <form @submit.prevent="submit" class="max-w-full mx-auto">
                        <div class="mt-4">
                            <InputLabel for="Grilled Meat" value="Grilled Meat" />

                            <TextInput id="grilled_meat" type="number" min="1" class="mt-1 block w-full" v-model="form.grilled_meat"
                                required autocomplete="Grilled Meat" />

                            <InputError class="mt-2" :message="form.errors.grilled_meat" />
                        </div>

                        <div class="mt-4">
                            <InputLabel value="Grilled Chicken" />

                            <TextInput type="number" min="1" class="mt-1 block w-full" v-model="form.grilled_chicken" required
                                autocomplete="grilled_chicken" />

                            <InputError class="mt-2" :message="form.errors.grilled_chicken" />
                        </div>
                        <div class="mt-4">
                            <InputLabel value="Tea" />

                            <TextInput type="number" min="1" class="mt-1 block w-full" v-model="form.tea_cups" required
                                autocomplete="tea_cups" />

                            <InputError class="mt-2" :message="form.errors.tea_cups" />
                        </div>
                        <div class="py-4">
                            <InputLabel class="" value="Additional Comment" />
                            <TextArea v-model="form.comments" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div class="py-4">
                            <button
                            class="w-full bg-yellow-400 px-3 py-3 font-bold text-lg rounded-lg shadow-sm cursor-pointer">
                            Book Table
                        </button>
                    </div>
                    </form>
                </div>
                <div class="text-xl font-medium text-gray-900 text-center py-4">Call Us For Reservations!</div>
                <div class="text-5xl font-bold text-gray-900 text-center py-4">07038989839</div>
        </div>
    </div>
</XeezacksgrillLayout>
</template>