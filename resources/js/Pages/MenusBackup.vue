<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { toRefs, computed } from 'vue'
import Slider from "@/Pages/Slider.vue";
import { ref } from 'vue';

defineProps({ menus: Object, categories: Object, categoryName: String, menu_item: Object });
// const { menus } = toRefs(props)

</script>

<template>
    <Head title="Food Menus" />

    <AuthenticatedLayout>
        <div class="grid place-items-center bg-gray-300 h-96">Menus</div>
        <div class="container mx-auto bg-white">
            <div
                class="flex-col-reverse sm:flex-col-reverse md:flex-col-reverse lg:flex-row flex-auto flex justify-between px-6">

                <div class="px-8 py-8">
                    <div class="px-4 pb-4 text-gray-900 text-xl font-bold">{{ categoryName }}</div>
                    <ul>
                        <template v-for="category in categories" :key="category.id">
                            <li class="py-2 px-4">
                                <Link :href="route('menus.index', {category: category.id})" class="text-lg font-semibold text-gray-700" href="#">{{ category.name }}</Link>
                            </li>
                        </template>
                    </ul>
                </div>
                <div class="px-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 p-5">
                        <template v-for="menu in $page.props.menus" :key="menu">
                            <Link :href="route('menu.show', { id: menu.id })" class="p-5 border border-gray-400 rounded-lg">
                            <div class="flex-col md:flex-row flex justify-center items-start gap-5 py-6">
                                <div v-if="menu.image != null" class="sm:w-full md:w-1/2 h-1/4">
                                    <img class="fill-current" :src="menu.image" alt="">
                                </div>
                                <div v-else class="sm:w-full md:w-1/2 h-1/4">
                                    <img class="fill-current" src="/images/sliders/slide1.jpg" alt="">
                                </div>
                                <div class="bg-gray-900"></div>
                                <div class="sm:w-full md:w-1/2 h-1/4">
                                    <div class="text-xl font-semibold text-gray-900">{{ menu.name }}</div>
                                    <div class="text-lg text-gray-900">{{ menu.description.substring(0, 40) }}</div>
                                </div>
                            </div>
                            <div class="flex-col sm:flex-col lg:flex-row flex justify-start gap-5">
                                <div class="text-xl font-semibold text-green-700">Price:</div>
                                <div class="text-xl font-semibold text-green-700">NGN {{ menu.price.toFixed(2) }}</div>
                            </div>
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>