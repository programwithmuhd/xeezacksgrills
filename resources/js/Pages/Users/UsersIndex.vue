<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { ref, toRefs, computed } from 'vue'
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({users: Object})

const form = useForm({})

const showConfirmDeleteUserModal = ref(false);

const confirmDeleteUser = () => {
    showConfirmDeleteUserModal.value = true;
}

const closeModal = () => {
    showConfirmDeleteUserModal.value = false;
}

const deleteUser = (id) => {

    // console.log(`The user Id is ${id}`)
    form.delete(route('menus-list.destroy', {id: id}), {
        onSuccess: () => closeModal()
    });
}

</script>

<template>
    <Head title="Food Menus" />

    <DashboardLayout>
        <div class="flex items-center justify-between bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Users</h2>
            </div>
            <div class="">
                <Link href="/users/create" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8">Add</LInk>
            </div>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">

            <div class="sm:w-full md:w-[300px]">
                <div class="rounded-full flex items-center bg-yellow-400 ">
                    <input type="text" class="
                                        form-control
                                        block
                                        w-full
                                        px-5
                                        py-1.5
                                        text-base
                                        font-normal
                                        text-gray-900
                                        bg-[#F4E3B4]
                                    placeholder-gray-400
                                    bg-clip-padding
                                    border
                                    border-solid
                                    border-l-gray-700
                                    border-y-gray-700 rounded-full
                                    transition
                                    ease-in-out
                                    m-0
                                    border-transparent
                                    focus:ring-0
                                " placeholder="Search" />
                </div>
            </div>

            <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                <div class="sm:w-full md:w-full overflow-auto rounded-lg shadow-lg mt-8">
                    <table class="w-full border border-spacing-1 border-gray-400">
                        <thead class="border-b bg-yellow-400 border-gray-400">
                            <tr class="">
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Name</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Surname</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Email</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Phone</th>
                                <th colspan="2" class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-400">
                            <template v-for="user in users" :key="user.id">
                                <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    {{ user.first_name }}
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">{{ user.last_name }}</td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">{{ user.mobile_number }}
                                </td>
                                <td class="p-3  text-center text-xl text-gray-700 whitespace-nowrap">
                                    {{ user.email }}
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <Link :href="route('users.edit', {user: user.id})" class=
                                    "
                                        text-sm
                                        md:text-sm 
                                        text-white 
                                        rounded-sm 
                                        shadow-sm 
                                        focus:outline-none 
                                        focus:ring-2 
                                        focus:ring-offset-2 
                                        bg-green-500 
                                        hover:bg-green-600 
                                        px-8 
                                        py-2
                                    ">Edit</Link>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button @click="confirmDeleteUser" 
                                    class="inline-flex 
                                    items-center 
                                    px-4 
                                    py-2 
                                    bg-red-600 
                                    border 
                                    border-transparent 
                                    rounded-md font-semibold 
                                    text-xs 
                                    text-white 
                                    uppercase 
                                    tracking-widest 
                                    hover:bg-red-500 
                                    active:bg-red-700 
                                    focus:outline-none 
                                    focus:ring-2 
                                    focus:ring-red-500 
                                    focus:ring-offset-2 
                                    transition 
                                    ease-in-out 
                                    duration-150
                                    "
                                    >Delete
                                </button>
                                <Modal :show="showConfirmDeleteUserModal" @close="closeModal">
                                    <div class="p-6">
                                        {{ user.id }}
                                        <h2 class="text-lg font-semibold text-slate-800">Are you sure you want delete this user?</h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="deleteUser(menu.id)">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                                </td>
                            </tr>
                            </template>
                            <template v-if="users.length === 0">
                                <tr>
                                    <td colspan="6" class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        No menus found.
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</DashboardLayout></template>