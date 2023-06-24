<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { toRefs, computed } from 'vue'
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';

import Slider from "@/Pages/Slider.vue";
import { useCartStore } from '@/store/cart'
import { storeToRefs } from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

const props = defineProps({menu_item: Object, image: String});
const { menu_item, image} = toRefs(props)

// defineProps({menu_item: Object});

// const addToCart = (menu_item) => {
//     cart.value.push(menu_item)
// }

// const isAlreadyInCart = computed(() => {
//     let res = cart.value.find(c => c.id === menu_item.value.id)
//     if (res) return true
//     return false
// })
</script>

<template>
    <Head title="Food Menus" />
    <XeezacksgrillLayout>
        <div class="grid place-items-center bg-gray-300 h-96">Menus</div>
        {{ menu_item.id }}
        <div class="max-w-7xl mx-auto">
            <div class="flex-col sm:flex-col md:flex-row flex justify-center px-4 py-6 gap-10">
                <div class="sm:w-full md:w-1/2 h-1/5">
                    <div>
                        <img class="object-fill object-contain" :src="image" alt="">
                    </div>
                </div>
                <div class="sm:w-full md:w-1/2 h-1/5">
                    <div class="text-xl font-medium text-gray-900 py-4">Available</div>
                    <div class="text-3xl font-bold text-gray-900 overflow-hidden">{{ menu_item.name }}</div>
                    <div class="text-lg text-gray-900 py-6 overflow-hidden">
                        {{ menu_item.description }}
                    </div>
                    <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                        <div class="text-xl text-gray-900 font-bold">
                        Price: NGN{{ menu_item.price.toFixed(2) }}
                    </div>
                    <div class="">
                        <button @click="cartStore.addToCart(menu_item.id)" class="text-sm md:text-sm text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 bg-yellow-200 hover:bg-yellow-400 px-8 py-2">
                            <span>Add to Cart</span>
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                <template v-for="random_menu in $page.props.random_menus" :key="random_menu">
                    <div class="">
                        <div class="w-52">
                            <img class="" src="/images/sliders/slide1.jpg" alt="">
                        </div>
                        <div class="w-52 text-lg font-medium text-gray-900 text-center py-2 px-2 overflow-x-hidden">
                            {{ random_menu.name }}
                        </div>
                        <div class="w-52 text-lg font-medium text-gray-900 text-center py-2 px-2 overflow-x-hidden">
                            NGN{{ random_menu.price.toFixed(2) }}
                        </div>
                        <div class="w-52 px-2 py-2 text-center">
                            <button type="submit" class="text-sm md:text-sm text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 bg-yellow-200 hover:bg-yellow-400 px-8 py-2">Select</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </XeezacksgrillLayout>
</template>