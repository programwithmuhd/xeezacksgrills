<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import CartMinusIcon from 'vue-material-design-icons/CartMinus.vue';
import CartIcon from 'vue-material-design-icons/Cart.vue';
import AccountLockOpen from 'vue-material-design-icons/AccountLockOpen.vue';
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import AccountCircleIcon from 'vue-material-design-icons/AccountCircle.vue';
import CloseIcon from 'vue-material-design-icons/Close.vue';
import ChevronRightIcon from 'vue-material-design-icons/ChevronRight.vue';

import { useCartStore } from '@/store/cart';

import axios from 'axios';
import { debounce } from 'lodash';
import { watch } from 'vue';
const cartStore = useCartStore()

let showMenu = ref(false)
const accountAndList = ref(false);

const accountAndListFunc = (bool) => {
    setTimeout(() => {
        accountAndList.value = bool
    }, 150)
}

const isOpen = ref(true)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}

const isLoading = ref(false)
const results = ref([])

const search = debounce(async (term) => {
    isLoading.value = true;
    let { data } = await axios.get('/api/search', { params: { search: term } });
    results.value = data;
    isLoading.value = false;
}, 250);


//   let searchItem = ref('')
//   let items = ref(null)

//   const searchByName = debounce(async () => {
//     items.value = await axios.get(`/api/search/${searchItem.value}`);
//   }, 250);

//   watch(() => searchItem.value, async () => {
//     if(!searchItem.value) {
//         setTimeout(() => {
//             items.value = '';
//             return
//         }, 500)
//     }
//     searchByName()
//     console.log(items.value)
//   })
</script>

<template>
    <div class="w-full">
        <div v-if="accountAndList" class="top-0 z-20 fixed w-full h-full bg-black bg-opacity-70"></div>
        <!-- {{ $page.props.auth.user }} -->
        <div class="w-full bg-[#F4E3B4]">
            <div class="h-6">
                <div class="flex justify-end items-center gap-4 px-6 py-4">
                    <div class="block sm:block md:hidden mobile-menu absolute top-2 left-4">
                        <svg @click="showMenu = !showMenu" class="w-10 h-14 cursor-pointer text-lg text-bold text-black"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </div>
                    <div class="flex gap-4 py-1">
                        <div class="relative h-auto" @mouseenter="accountAndListFunc(true)"
                            @mouseleave="accountAndListFunc(false)">
                            <AccountLockOpen size="30" />
                            <div v-if="accountAndList"
                                class="bg-white absolute z-50 top-[56px] right-[0px] w-[320px] rounded-sm px-6">
                                <div v-if="$page.props.auth.user">
                                    <div class="flex items-center justify-between py-2.5 border-b">
                                        <div class="text-smp-2">Select a profile.</div>
                                        <div
                                            class="flex items-center text-sm font-bold text-teal-600 hover:text-red-600 hover:underline">
                                            Manage profile
                                            <ChevronRightIcon :size="20" fillColor="#808080" />
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="pb-3">
                                            <div class="font-extrabold text-center pt-3">Your Account</div>
                                            <div class="flex justify-between gap-10">
                                                <Link :href="route('login')"
                                                    class="text-sm block hover:text-red-600 hover:underline pt-3">
                                                Account
                                                </Link>
                                                <Link :href="route('logout')" method="post" as="button"
                                                    class="text-sm block hover:text-red-600 hover:underline pt-3">
                                                Sign Out
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-else class="p-4 text-center">
                                    <div class="p-4 text-center"></div>
                                    <Link :href="route('login')" class="
                                        text-center
                                        items-center
                                        px-20
                                        py-1.5
                                        bg-[#fcba1f]
                                        border
                                        border-gray-600
                                        rounded-sm
                                        text-sm
                                        font-extrabold
                                        text-black
                                    ">
                                    Sign in
                                    </Link>
                                    <div class="text-sm pt-4">
                                        New customer?
                                        <Link :href="route('address.create')" class="text-blue-700 hover:text-red-700">
                                        Start here.
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Link href="/cart" class="flex">
                        <div class="relative">
                            <span class="absolute bottom-6 left-2.5"><b>{{ cartStore.productsTotal }}</b></span>
                            <div class="relative">
                                <CartIcon size="30" />
                            </div>
                        </div>
                        </Link>
                    </div>
                </div>
            </div>
            <nav class="w-full mx-auto bg-[#F4E3B4] flex flex-col items-center gap-5 lg:flex-row justify-between px-6 py-0">
                <!-- Logo -->
                <div class="object-contain logo mb-2">
                    <a class="" href="/">
                        <img class="w-[180px] min-h-[120px] md:overflow-hidden object-cover"
                            src="/images/logos/footer-logo.jpg" alt="">
                    </a>
                </div>

                <div class="flex flex-col items-center gap-5 lg:flex-row justify-between px-6">
                    <div class="relative w-full">
                        <input @input="(e) => search(e.target.value)"
                            class="min-w-[300px] w-full px-6 border-[#F4E3B4] bg-white focus:border-yellow-400 focus:ring-yellow-400 rounded-full shadow-sm"
                            type="search" name="">
                        <div v-if="results.length > 0 && !isLoading" class="absolute z-10 w-full p-1">
                            <template v-for="menu in results" :key="menu.id">
                                <div class="border border-gray-400 w-full cursor-pointer text-black bg-white">
                                    <Link :href="menu.url">
                                    <div class="flex items-center py-4 px-2">
                                        <div class="text-clip text-gray-900 ml-2">{{ menu.title }}</div>
                                    </div>
                                    </Link>
                                </div>
                            </template>
                        </div>
                    </div>
                    <!-- End of logo div -->
                    <div class="menu-navs order-2 sm:order-2 md:order-2 lg:order-1">
                        <div>
                            <ul class="md:flex flex-col sm:flex-col md:flex-row lg:flex-row items-center transition ease-in-out delay-150"
                                :class="showMenu ? ['flex'] : 'hidden'">
                                <li class="px-2.5 py-4">
                                    <Link
                                        class="text-lg font-semibold text-gray-900 hover:text-black hover:bg-yellow-400 py-3 px-2.5"
                                        :href="route('about.index')">About</Link>
                                </li>
                                <li class="px-2.5 py-4">
                                    <Link
                                        class="text-lg font-semibold text-gray-900 hover:text-black hover:bg-yellow-400 py-3 px-2.5 700"
                                        href="/">Home</Link>
                                </li>
                                <li class="px-2.5 py-4">
                                    <Link
                                        class="text-lg font-semibold text-gray-900 hover:text-black hover:bg-yellow-400 py-3 px-2.5 700"
                                        href="/menus">Menu</Link>
                                </li>
                                <li class="px-2.5 py-4">
                                    <Link
                                        class="text-lg font-semibold text-gray-900 hover:text-black hover:bg-yellow-400 py-3 px-2.5 700"
                                        href="/reservation">Reservation</Link>
                                </li>
                                <li class="px-2.5 py-4">
                                    <Link
                                        class="text-lg font-semibold text-gray-900 hover:text-black hover:bg-yellow-400 py-3 px-3 700"
                                        :href="route('contact.index')">Contact</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </nav>
        </div>
        <!-- End of the copied nav -->
        <!-- <div class="grid place-items-center h-60 bg-slate-400">Slider</div> -->
        <div class="bg-white w-full">
            <slot />
        </div>
        <div class="w-full py-8 bg-[#F4E3B4]">
            <div class="container mx-auto flex flex-col flex-auto lg:flex-row justify-between px-6 py-6">
                <div>
                    <img class="w-64" src="/images/logos/footer-logo.jpg" alt="" srcset="">
                </div>
                <div>
                    <div class="text-3xl font-semibold text-gray-900">
                        Our Location
                        <p class="text-xl font-semibold text-gray-900">Unguwar Rimin Kaduna</p>
                    </div>
                </div>
                <div>
                    <div class="text-3xl font-semibold text-gray-900">
                        Quick Links
                        <div class="">
                            <ul>
                                <li>
                                    <a href="" class="text-xl font-semibold text-gray-900 text-gray-900">Home</a>
                                </li>
                                <li>
                                    <a href="" class="text-xl font-semibold text-gray-900 text-gray-900">About us</a>
                                </li>
                                <li>
                                    <a href="" class="text-xl font-semibold text-gray-900 text-gray-900">Online order</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-3xl font-semibold text-gray-900">
                        Opening hours
                        <p class="text-xl font-semibold text-gray-900">Monday-Friday</p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="w-full bg-[#F4E3B4] text-center text-lg font-medium text-gray-900 py-12 leading-normal border-t border-t-black">
            &copy;2023 All Rights Reserved Xeexacks Grill House
        </div>
    </div>
</template>