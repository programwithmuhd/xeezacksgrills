<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Slider from "@/Pages/Slider.vue";

const form = useForm({
    name: null,
    phone: null,
    email: null,
    grilled_meat: null,
    grilled_chicken: null,
    tea_cups: null,
    comments: '',
});

const submit = () => {
    form.post(route('reservation.index'));
};

</script>

<template>
    <Head title="About" />

    <XeezacksgrillLayout>
        <div class="w-full grid place-items-center bg-black opacity-80 h-60">
            <div class="max-w-7xl mx-auto">
                <div class="text-5xl text-gray-200 text-center">Reservation</div>
            </div>
        </div>
        <div class="w-full bg-white h-auto">
            <div class="bg-white">
                <div class="text-5xl text-gray-200 text-center">
                    <h2 class="md:text-5xl text-5xl font-black text-gray-900 leading-tight py-6">
                            Reservation</h2>
                </div>
                <div class="max-w-xl mx-auto mb-8">
                    <form @submit.prevent="submit" class="max-w-full mx-auto">
                        <div class="mt-4">
                            <InputLabel for="Enter your name" value="Enter name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                required autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="Phone number" value="Enter Phone number" />

                            <TextInput id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone"
                                required autocomplete="" />

                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Enter your email(optional)" />

                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                autocomplete="" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="Grilled Meat" value="Grilled Meat(How many sticks?)" />

                            <TextInput id="grilled_meat" type="number" min="0" class="mt-1 block w-full" v-model="form.grilled_meat"
                                required autocomplete="Grilled Meat" />

                            <InputError class="mt-2" :message="form.errors.grilled_meat" />
                        </div>

                        <div class="mt-4">
                            <InputLabel value="Grilled Chicken(How many?)" />

                            <TextInput type="number" min="0" class="mt-1 block w-full" v-model="form.grilled_chicken" required
                                autocomplete="grilled_chicken" />

                            <InputError class="mt-2" :message="form.errors.grilled_chicken" />
                        </div>
                        <div class="mt-4">
                            <InputLabel value="Tea(How many cups?)" />

                            <TextInput type="number" min="0" class="mt-1 block w-full" v-model="form.tea_cups"
                                autocomplete="tea_cups" />

                            <InputError class="mt-2" :message="form.errors.tea_cups" />
                        </div>
                        <div class="py-4">
                            <InputLabel class="" value="Additional Comment" />
                            <TextArea v-model="form.comments" type="text" class="mt-1 block w-full"/>
                        </div>
                        <div class="py-4">
                            <button
                            class="w-full bg-yellow-400 px-3 py-3 font-bold text-lg rounded-lg shadow-sm cursor-pointer">
                            Book Table
                        </button>
                    </div>
                    </form>
                </div>
            </div>        
        </div>
    </XeezacksgrillLayout>
</template>