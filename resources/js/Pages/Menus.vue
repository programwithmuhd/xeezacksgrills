<script setup>
import { Head, Link } from '@inertiajs/vue3';
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';
import { toRefs, computed } from 'vue'
import Slider from "@/Pages/Slider.vue";
import { ref } from 'vue';
import { useCartStore } from '@/store/cart'
import { storeToRefs } from 'pinia';
const cartStore = useCartStore()

defineProps({ menus: Object, categories: Object, categoryName: String, menu_item: Object });
// const { menus } = toRefs(props)

</script>

<template>
    <Head title="Food Menus" />

    <XeezacksgrillLayout>
        <div class="">
            <div class="lg:h-[600px]">
                <img class="w-full h-full object-contain object-cover" src="/images/burger.jpg" alt="">
            </div>
        </div>
        <div class="w-full mx-auto bg-white">
            <div class="max-w-7xl mx-auto px-4 pb-8 mt-10">
                <div class="flex-col-reverse sm:flex-col-reverse md:flex-col-reverse lg:flex-row flex-auto flex justify-between gap-5">
                    <aside class="w-1/5">
                        <section>
                            <h5 class="text-2xl text-black uppercase font-bold py-2">Menus</h5>

                            <ul class="none mt-4">
                                <template v-for="category in categories" :key="category.id">
                                    <li class="text-xl leading-10">
                                        <Link :href="route('menus.index', {category: category.id})" class="text-black">{{ category.name }}</Link>
                                    </li>
                                </template>
                            </ul>
                        </section>
                    </aside>
                    <div class="w-4/5">
                        <h1 class="text-3xl text-gray-900 font-bold leading-none py-2 mb-3">{{ categoryName }}</h1>
                        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                            <template v-for="menu in menus" :key="menu.id">
                                <div class="py-4">
                                    <Link :href="route('menu.show', { id: menu.id })" class="">
                                        <img class="object-contain h-40" :src="menu.image" alt="" srcset="">
                                    </Link>
                                    <div class="px-4 py-2 text-center border-x-2 border-x-gray-200 border-b-2 border-b-black shadow-lg">
                                        <h2 class="text-xl text-gray-700 font-semibold">{{ menu.name.substring(0, 12) }}</h2>
                                        <p class="text-lg text-gray-900 font-light mt-2">NGN{{ menu.price }}</p>
                                        <div class="mt-4 flex-col sm:flex-col md:flex-row flex items-center justify-between">
                                            <Link :href="route('menu.show', { id: menu.id })">Read More</Link>
                                            <div class="py-3">
                                                <button @click="cartStore.addToCart(menu_item.id)" class="text-sm md:text-sm text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 bg-yellow-200 hover:bg-yellow-400 px-2 py-2">
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-if="menus.length === 0">
                                <div class="py-4">
                                    No Favourites found
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </XeezacksgrillLayout>
</template>