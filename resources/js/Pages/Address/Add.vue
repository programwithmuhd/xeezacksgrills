<script setup>
import { reactive, ref, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
    first_name: usePage().props.auth.user.first_name,
    last_name: usePage().props.auth.user.last_name,
    state: '',
    city: '',
    district: '',
    address: '',
})

let submit = () => {
    form.post(route('address.store'), {
        onFinish: () => route('landing-page.index')
    })
}

</script>

<template>
    <Head title="Food Menus" />

    <GuestLayout>

        <Head title="Register" />
        {{ usePage().props.auth.user.first_name }}
        <div class="flex-col sm:flex-col md:flex-row flex items-center justify-between gap-10">
            <form @submit.prevent="submit" class="max-w-full mx-auto">
            <div class="flex-col sm:flex-col md:flex-row flex item-center gap-5">
                <div class="py-4">
                    <InputLabel class="" value="First name" />
                    <TextInput v-model="form.first_name" type="text" class="mt-1 block w-full" required />
                </div>
                <div class="py-4">
                    <InputLabel class="" value="Last name" />
                    <TextInput v-model="form.last_name" type="text" class="mt-1 block w-full" required />
                </div>
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
                    Place order
                </button>
            </div>
        </form>
        </div>
    </GuestLayout>
</template>