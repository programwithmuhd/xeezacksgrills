<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { ref, toRefs, computed, watch, reactive } from 'vue'
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Pagination from '@/Components/Pagination.vue';
import { throttle, pickBy } from 'lodash';

const props = defineProps({ menus: Object, filters: Object, field: Object, direction: Object })

const menusFilter = reactive({
    search: props.filters.search,
    column: props.filters.column,
    direction: props.filters.direction
});

watch(menusFilter,
    throttle(() => {
        let query = pickBy(menusFilter);
        let queryRoute = route('menus-list.index', Object.keys(query).length ? query : {
            remember: 'forget'
        });
        router.get(queryRoute, {}, {
            preserveState: true,
            replace: true,
        });
    }, 500),
    {
        deep: true,
    }
)

const sort = (field) => {
    menusFilter.field = field;
    menusFilter.direction = menusFilter.direction === 'asc' ? 'desc' : 'asc';
}

</script>

<template>
    <Head title="Food Menus" />

    <DashboardLayout>
        <div class="flex items-center justify-between bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Favorites</h2>
            </div>
            <div class="">
                <Link 
                    :href="route('menus-list.create')"
                    class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8">
                    Add
                </LInk>
            </div>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">

            <div class="sm:w-full md:w-[300px]">
                <div class="rounded-full flex items-center bg-yellow-400 ">
                    <input v-model="menusFilter.search" type="text" class="
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
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Image</th>
                                <th @click="sort('name')"
                                    class="w-25 p-3 text-xl font-semibold tracking-wide text-center cursor-pointer">
                                    <div class="flex justify-center space-x-4 content-center">
                                        <span>Favorite</span>
                                        <svg v-if="menusFilter.field === 'name' && menusFilter.direction === 'desc'"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75" />
                                        </svg>

                                        <svg v-if="menusFilter.field === 'name' && menusFilter.direction === 'asc'"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75" />
                                        </svg>
                                    </div>
                                </th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Price</th>
                                <th colspan="2" class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-400">
                            <template v-for="menu in menus.data" :key="menu.id">
                                <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                    <div class="w-16">
                                        <img class="object-fill object-contain rounded-full" :src="menu.image" alt="">
                                    </div>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        {{ menu.name }}
                                    </td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        NGN{{ menu.price }}
                                    </td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        <Link :href="route('menus-list.edit', { id: menu.id })" class="inline-flex items-center px-4 py-2 
                                        bg-green-500 border border-transparent 
                                        rounded-md font-semibold text-xs text-white 
                                        uppercase tracking-widest 
                                        hover:bg-green-600 active:bg-green-700 
                                        focus:outline-none focus:ring-2 
                                        focus:ring-green-500 focus:ring-offset-2 
                                        transition ease-in-out duration-150
                                    ">Edit</Link>
                                    </td>
                                </tr>
                            </template>
                            <template v-if="menus.length === 0">
                                <tr>
                                    <td colspan="6" class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        No Food Favorites Found.
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="m-2 p-2">
                        <Pagination :Links="menus.links" />
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>