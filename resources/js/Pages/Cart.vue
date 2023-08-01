<script setup>
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue'
import { ref, toRefs, computed } from 'vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import PlusIcon from 'vue-material-design-icons/Plus.vue'
import MinusIcon from 'vue-material-design-icons/Minus.vue'
import TrashIcon from 'vue-material-design-icons/Delete.vue'
import Slider from "@/Pages/Slider.vue";

import { useCartStore } from '@/store/cart'
import { storeToRefs } from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

const props = defineProps({menus: Object});


const formattedCart = computed(() => {
    return Object.keys(cartStore.cartContent).map(menuId => {
        const menu = cartStore.cartContent[menuId];

        return {
          id: menu.id,
          image: props.menus.find((c) => c.id === menu.id).image,
          name: props.menus.find((c) => c.id === menu.id).name,
          price: props.menus.find((c) => c.id === menu.id).price,
          quantity: menu.quantity,
          cost: menu.quantity * props.menus.find((c) => c.id === menu.id).price,
        }
      })
});

const cartTotal = computed(() => {
    return Object.keys(cartStore.cartContent).reduce((acc, id) => {
        const menu = props.menus.find(m => m.id == id);
        if(menu) {
            return acc + menu.price * cartStore.cartContent[id].quantity 
        }
        return acc + 0;
    }, 0);
});

</script>

<template>
    <Head title="Food Menus" />

    <XeezacksgrillLayout>
        <div class="container mx-auto px-4 py-6">
            <div class="px-4 py-6 text-center text-3xl font-semibold text-gray-900">Your Cart Menus</div>
            <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                <div class="sm:w-full md:w-3/4 overflow-auto rounded-lg shadow-lg mt-8">
                    <table class="w-full border border-spacing-1 border-gray-400">
                        <thead class="border-b border-gray-400">
                            <tr class="">
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Image</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Name</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Price</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Quantity</th>
                                <th class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-400">
                            <template v-if="!formattedCart.length">
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        Your cart menu is empty!
                                    </td>
                                </tr>
                            </template>
                            <template v-for="menu in formattedCart" :key="menu.id">
                                <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        <div class="w-20">
                                            <img class="object-fill object-contain" :src="menu.image" alt="">
                                        </div>
                                    </td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">{{ menu.name }}</td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">NGN{{ menu.price * menu.quantity }}</td>
                                    <td class="p-3  text-center text-xl text-gray-700 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <MinusIcon @click="cartStore.removeFromCart(menu.id)" class="cursor-pointer px-8 text-2xl font-bold text-black" size="30" />
                                            <div class="px-8 text-2xl font-bold text-black">{{ menu.quantity }}</div>
                                            <PlusIcon @click="cartStore.addToCart(menu.id)" class="cursor-pointer px-8 text-2xl font-bold text-black" size="30" />
                                        </div>
                                    </td>
                                    <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                        <TrashIcon class="cursor-pointer text-red-600" @click="cartStore.removeMenuFromCart(menu.id)" size="40" />
                                    </td>
                                </tr>
                            </template>
                            <!-- <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <div class="w-20">
                                        <img class="object-fill object-contain" src="/images/sliders/slide1.jpg" alt="">
                                    </div>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Two</td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Three</td>
                                <td class="p-3  text-center text-xl text-gray-700 whitespace-nowrap">
                                    <input type="number" name="email" value="" class="w-24 border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Update</button>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Delete</button>
                                </td>
                            </tr>
                            <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <div class="w-20">
                                        <img class="object-fill object-contain" src="/images/sliders/slide1.jpg" alt="">
                                    </div>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Two</td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Three</td>
                                <td class="p-3  text-center text-xl text-gray-700 whitespace-nowrap">
                                    <input type="number" name="email" value="" class="w-24 border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Update</button>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Delete</button>
                                </td>
                            </tr>
                            <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <div class="w-20">
                                        <img class="object-fill object-contain" src="/images/sliders/slide1.jpg" alt="">
                                    </div>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Two</td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Three</td>
                                <td class="p-3  text-center text-xl text-gray-700 whitespace-nowrap">
                                    <input type="number" name="email" value="" class="w-24 border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Update</button>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Delete</button>
                                </td>
                            </tr>
                            <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <div class="w-20">
                                        <img class="object-fill object-contain" src="/images/sliders/slide1.jpg" alt="">
                                    </div>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Two</td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Three</td>
                                <td class="p-3  text-center text-xl text-gray-700 whitespace-nowrap">
                                    <input type="number" name="email" value="" class="w-24 border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Update</button>
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    <button type="submit" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Delete</button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>

                    <div class="flex-col sm:flex-col md:flex-row flex justify-between px-6 py-8">
                        <div class="">
                            <Link href="/menus" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Continue Ordering</LInk>
                        </div>
                        <div class="">
                            <!-- <Link href="/checkout" class="text-lg md:text-lg text-gray-900 rounded-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-8 py-2">Checkout</Link>
                            
                            -->

                            <Link
                                :disabled="cartTotal === 0"
                                :class="cartTotal === 0 ? 'bg-gray-400' : 'bg-green-500 hover:bg-green-600'"
                                as="button"
                                :href="$page.props.auth.user !== null ? route('checkout.index') : route('login')"
                                class="
                                    block
                                    w-full
                                    text-center
                                    px-8
                                    py-2
                                    font-bold
                                    text-sm
                                    text-white
                                    rounded-lg
                                    border
                                    shadow-sm
                                    cursor-pointer
                                "
                            >
                                Proceed to Checkout
                            </Link>
                        </div>
                    </div>

                </div>
                <div class="sm:w-full md:w-1/4 overflow-auto rounded-lg shadow-lg mt-8">
                    <table class="w-full border border-spacing-1 border-gray-400">
                        <thead>
                            <th colspan="2" class="w-25 p-3 text-xl font-semibold tracking-wide text-center">Subtotal</th>
                        </thead>
                        <tbody class="divide-y divide-gray-400">
                            <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">
                                    Items({{ cartStore.productsTotal }})
                                </td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Shipping</td>
                            </tr>
                            <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Shipping</td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap">Free</td>
                            </tr>
                            <tr class="even:bg-[#EDD2877D] odd:bg-gray-200">
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap"><b>Subtotal</b></td>
                                <td class="p-3 text-center text-xl text-gray-700 whitespace-nowrap"><b>NGN{{ cartTotal }}</b></td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </XeezacksgrillLayout>
</template>