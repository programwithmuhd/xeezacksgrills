<script>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { router, Link, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { pickBy } from 'lodash';
import { throttle } from 'lodash';
export default {
    components: {
        DashboardLayout,
        Pagination,
        Link,
        Modal,
        DangerButton,
        SecondaryButton,
    },

    props: {
        menus: Object,
        filters: Object,
    },

    data() {
        return {
            form: useForm({}),
            showConfirmDeleteMenuModal: false,
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            }
        }
    },

    methods: {
        confirmDeleteMenu() {
            this.showConfirmDeleteMenuModal = true;
        },
        closeModal() {
            this.showConfirmDeleteMenuModal = false;
        },
        deleteMenu(id) {
            this.form.delete(`/menus-list/${id}`, {
                onSuccess: () => closeModal()
            });
        },
        sort(field) {
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        }
    },

    watch: {
        params: {
            handler: throttle(function () {

                let params = pickBy(this.params);

                this.$inertia.get(route('menus-list.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true
        }
    }
}
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
                    <input v-model="params.search" type="text" class="
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
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">
                                    <div>
                                        <span class="inline-flex items-center justify-center" @click="sort('name')">Name
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75" />
                                            </svg>

                                            <svg v-if="params.field === 'name' && params.direction === 'desc'"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75" />
                                            </svg>
                                        </span>
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
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        <div class="w-16">
                                            <img class="object-fill object-contain rounded-full" :src="menu.image" alt="">
                                        </div>
                                    </td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">{{ menu.name }}</td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        NGN{{ menu.price }}
                                    </td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        <Link :href="route('menus-list.edit', { id: menu.id })" class="
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
                                    <td>
                                        <button @click="deleteMenu(route('menus-list.destroy', { id: menu.id }))" class="inline-flex 
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
                                    ">Delete
                                        </button>
                                        <!-- <Modal :show="showConfirmDeleteMenuModal" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-slate-800">Are you sure you want delete this favourite?</h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="deleteMenu(route('menus-list.destroy', { id: menu.id }))">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal> -->
                                    </td>
                                </tr>
                            </template>
                            <template v-if="menus.length === 0">
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        No menus found.
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Pagination :Links="menus.Links" class="bg-red-500" />
    </DashboardLayout>
</template>