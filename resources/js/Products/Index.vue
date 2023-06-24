<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { toRefs, computed } from 'vue'

</script>

<template>
    <Head title="Food Menus" />

    <DashboardLayout>
        <div class="flex items-start bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Products</h2>
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
                            <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    Muhammad
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Abubakar</td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">talktomuhd@gmail.com
                                </td>
                                <td class="p-3  text-center text-xl text-gray-700 whitespace-nowrap">
                                    08036854530
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit"
                                        class="text-sm md:text-sm text-white rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 bg-green-500 hover:bg-green-600 px-8 py-2">Update</button>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit"
                                        class="text-sm md:text-sm text-white rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 bg-red-500 hover:bg-red-600 px-8 py-2">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</DashboardLayout></template>