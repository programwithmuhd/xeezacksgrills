<script setup>
import { ref, watch } from 'vue';
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
// import RouterLinkButton from '@/Components/RouterLinkButton.vue';
import { toRefs, computed } from 'vue'

const props = defineProps({ categories: Object })

let search = ref('')

const field = ref('')
const direction = ref('')

const sort = (field) => {
    field.value = field;
    direction.value = direction.value === 'asc' ? 'desc' : 'asc';
}

watch(search, value => {
    router.get('/categories-favorites', {search: value}, {
        preserveState: true
    })
})

</script>

<template>
    <Head title="Categories Menus" />

    <DashboardLayout>
    <div class="flex items-center justify-between bg-white px-6">
        <div class="">
            <h2 class="text-xl font-bold px-4 py-[22px]">Categories</h2>
        </div>
        </div>
        <div class="bg-gray-200 px-6 pt-16">
            <div class="flex-col md:flex-row items-center justify-end -mt-10 pb-8">
                <div class="">
                    <Link :href="route('categories-favorites.create')"
                        class="bg-blue-600 text-lg md:text-lg text-white rounded-xl shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">
                    Add</LInk>
                </div>
            </div>
            <div class="sm:w-full md:w-[300px]">
                <div class="rounded-full flex items-center justify-end bg-yellow-400">
                    <input v-model="search" type="text" class="
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
                                <th @click="sort('name')" class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Name</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Slug</th>
                                <th colspan="2" class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-400">
                            <template v-for="category in categories.data" :key="category.id">
                                <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">{{ category.name }}</td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">{{ category.slug }}</td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        <Link :href="route('categories-favorites.edit', {category: category.id})" class="
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
                                            py-2">
                                        Update
                                        </Link>
                                    </td>
                                </tr>
                            </template>
                            <template v-if="categories.length === 0">
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        No categories found.
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>