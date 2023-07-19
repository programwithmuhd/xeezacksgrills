<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    first_name: '',
    last_name: '',
    mobile_number: '',
    email: '',
    password: '',
    state: '',
    city: '',
    district: '',
    address: '',
});

const submit = () => {
    form.post(route('address.store'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit" class="max-w-full mx-auto">
            <div class="mt-4">
                <InputLabel for="first_name" value="First name" />

                <TextInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required
                    autocomplete="first_name" />

                <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div class="mt-4">
                <InputLabel value="Last name" />

                <TextInput type="text" class="mt-1 block w-full" v-model="form.last_name" required
                    autocomplete="last_name" />

                <InputError class="mt-2" :message="form.errors.last_name" />
            </div>
            <div class="mt-4">
                <InputLabel value="Mobile number" />

                <TextInput type="text" class="mt-1 block w-full" v-model="form.mobile_number" required
                    autocomplete="mobile_number" />

                <InputError class="mt-2" :message="form.errors.mobile_number" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="flex-col sm:flex-col md:flex-row flex item-center gap-5">
                <div class="py-4 w-full">
                    <InputLabel class="" value="State" />
                    <select v-model="form.state" class="mt-1 block 
                        w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                        " name="state">
                        <option selected value="Kaduna">Kaduna</option>
                    </select>
                </div>
                <div class="py-4 w-full">
                    <InputLabel class="" value="City" />
                    <select v-model="form.city" class="mt-1 block 
                        w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                        " name="country">
                        <option selected value="Kaduna">Kaduna</option>
                    </select>
                </div>
            </div>
            <div class="py-4">
                <div class="py-4 w-full">
                    <InputLabel class="" value="District" />
                    <select v-model="form.district" class="mt-1 block 
                        w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                        " name="country">
                        <option selected value="United Kingdom">Ali Akilu</option>
                        <option value="Unguwar Rimi">Unguwar Rimi</option>
                        <option value="Malali">Malali</option>
                        <option value="Unguwar Sarki">Unguwar Sarki</option>
                        <option value="Badarawa">Badarawa</option>
                        <option value="Unguwar Dosa">Unguwar Dosa</option>
                        <option value="Sabon Kawo">Sabon Kawo</option>
                    </select>
                </div>
            </div>
            <div class="py-4">
                <InputLabel class="" value="Enter Address line" />
                <TextArea v-model="form.address" type="text" class="mt-1 block w-full" required />
            </div>
            <div class="py-4">
                <button class="w-full bg-yellow-400 px-3 py-3 font-bold text-lg rounded-lg shadow-sm cursor-pointer">
                    Add Address
                </button>
            </div>
        </form>
    </GuestLayout>
</template>