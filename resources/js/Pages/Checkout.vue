<script setup>
import { reactive, ref, computed } from 'vue'
// import { Head, Link, router } from '@inertiajs/vue3';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Slider from "@/Pages/Slider.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PlusIcon from 'vue-material-design-icons/Plus.vue'
import { useCartStore } from '@/store/cart'
import { storeToRefs } from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)


const props = defineProps({ menus: Object });

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

const total = computed(() => {
    return Object.keys(cartStore.cartContent).reduce((acc, id) => {
        const menu = props.menus.find(m => m.id == id);
        if (menu) {
            return acc + menu.price * cartStore.cartContent[id].quantity
        }
        return acc + 0;
    }, 0);
});


const form = reactive({
    phone: usePage().props.auth.user.phone,
    email: usePage().props.auth.user.email,
    amount: total,
});

// Paystack codes goes here

let submit = () => {
    router.post('/checkout', form)
}




</script>

<template>
    <Head title="Food Menus" />

    <XeezacksgrillLayout>
        
        <Head title="Checkout" />
        <div class="w-full bg-gray-200">
            {{ $page.props.auth.user }}
            <div class="max-w-7xl bg-gray mx-auto">
                <div class="flex flex-col sm:flex-col lg:flex-row p-6 gap-4">
                    <div class="w-full lg:w-3/5">
                        <div class="bg-white p-4">
                            <h2 class="text-xl text-black font-black">Shipping Address</h2>
                            <div class="flex py-2 text-blue-600 text-lg font-semibold">
                                <PlusIcon size="30" />Update Address
                            </div>
                            <div class="text-black text-lg underline font-bold">Delivery Address</div>
                            <div class="text-gray-900 text-sm font-semibold"><span
                                    class="text-sm text-gray-900 font-semibold">{{ usePage().props.auth.user.first_name }}
                                    {{ usePage().props.auth.user.last_name }}</span></div>
                            <div class="text-gray-900 text-sm font-semibold"><span
                                    class="text-sm text-gray-900 font-semibold">{{ usePage().props.auth.user.phone }}</span></div>
                                    <div class="text-gray-900 text-sm font-semibold"><span
                                    class="text-sm text-gray-900 font-semibold">Nigeria</span></div>
                            <div class="text-gray-900 text-sm font-semibold"><span
                                    class="text-sm text-gray-900 font-semibold">Kaduna</span></div>
                            <div class="text-gray-900 text-sm font-semibold"><span
                                    class="text-sm text-gray-900 font-semibold">{{ usePage().props.auth.address.district
                                    }}</span></div>
                            <div class="text-gray-900 text-sm font-semibold"><span
                                    class="text-sm text-gray-900 font-semibold">{{ usePage().props.auth.address.address
                                    }}</span></div>
                        </div>
                        <div class="bg-white p-4 mt-4">
                            <template v-for="menu in formattedCart" :key="menu">
                                <div class="flex items-center gap-2">
                                    <div class="w-1/5">
                                        <div class="">
                                            <img class="w-44 md:overflow-hidden object-cover" :src="menu.image" />
                                        </div>
                                    </div>
                                    <div class="w-4/5 self-start">
                                        <div class="text-gray-900 text-lg font-semibold">{{ menu.name }}</div>
                                        <div class="text-gray-900 text-2xl font-black">NGN{{ menu.price }}</div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="w-full lg:w-2/5">
                        <div class="bg-white">
                            <div class="bg-white p-4">
                                <h2 class="text-xl text-black font-black">Summary</h2>
                                <div class="flex items-center justify-between mt-2">
                                    <div class="text-gray-900 text-sm font-semibold">Total Shipping</div>
                                    <div class="text-gray-900 text-sm font-semibold">Free</div>
                                </div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="text-gray-900 text-sm font-semibold">Total:</div>
                                    <div class="text-gray-900 text-2xl font-black">NGN{{ total }}</div>
                                </div>
                                <form @submit.prevent="submit">
                                    <div class="py-4">
                                        <TextInput v-model="form.phone" type="hidden" class="mt-1 block w-full" required />
                                    </div>
                                    <div class="py-4">
                                        <TextInput v-model="form.email" type="hidden" class="mt-1 block w-full" required />
                                    </div>
                                    <div class="py-4">
                                        <TextInput v-model="form.amount" type="hidden" class="mt-1 block w-full" required />
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="
                                                bg-yellow-400
                                                block
                                                w-full
                                                text-center
                                                px-8
                                                py-3
                                                font-bold
                                                text-2xl
                                                rounded-lg
                                                border
                                                shadow-sm
                                                cursor-pointer
                                            ">
                                            Place order
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="bg-white p-4 mt-4">
                            <h2 class="text-2xl text-black font-black">Xeexacksgrills</h2>
                            <div class="mt-2">
                                <div class="text-gray-900 text-lg font-semibold">Xeezacks grills keeps your information and
                                    payment safe</div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</XeezacksgrillLayout></template>