<script setup>
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import {ref, toRefs, computed } from 'vue'


const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
});

const submit = () => {
    form.post('/users')
}

</script>

<template>
    <Head title="Food Menus List" />
    <DashboardLayout>
        <div class="flex items-start bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Add New Users</h2>
            </div>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">


            <div class="bg-white max-w-xl px-8 py-8">
                <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                    <form @submit.prevent="submit">
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="First name" />
                                <TextInput v-model="form.first_name" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Last name" />
                                <TextInput v-model="form.last_name" type="text" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Email" />
                                <TextInput v-model="form.email" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Password" />
                                <TextInput v-model="form.password" type="password" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        
                        <div class="py-4">
                            <button type="submit"
                                class="w-full bg-yellow-400 px-3 py-3 font-bold 
                                text-lg rounded-lg shadow-sm cursor-pointer">
                                Add Users
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>