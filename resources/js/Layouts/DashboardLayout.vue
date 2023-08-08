<script setup>
import { ref, onMounted } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import SideNavItem from '../Components/SideNavItem.vue'
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import MagnifyIcon from 'vue-material-design-icons/Magnify.vue';
import AccountLockOpen from 'vue-material-design-icons/AccountLockOpen.vue';
import Logout from 'vue-material-design-icons/Logout.vue';

let showMenu = ref(false);
let openSideNav = ref(true);
let openSideNavOverlay = ref(false);
let sideNavOverlay = ref(null);
let width = ref(document.documentElement.clientWidth);

onMounted(() => {
    resize()
    sideNavOverlay.value.classList.value = sideNavOverlay.value.classList.value += ' hidden'
    window.addEventListener('resize', () => {
        width.value = document.documentElement.clientWidth;
        resize()
    });
})

const resize = () => {
    if (width.value < 1280 && openSideNav.value) {
        openSideNav.value = false
    }
    if (width.value > 1279 && !openSideNav.value) {
        openSideNav.value = true
    }
}

const isNavOverlay = () => {
    if (usePage().url) openSideNav.value = !openSideNav.value
    if (width.value < 640) openSideNavOverlay.value = !openSideNavOverlay.value
    if (usePage().url !== usePage().url && width.value < 640) openSideNavOverlay.value = !openSideNavOverlay.value
    // if (usePage().props.video) openSideNavOverlay.value = !openSideNavOverlay.value
}

</script>

<template>
    <div class="relative">
        <div id="TopNav" class="w-[100%] h-[100px] bg-[#F4E3B4] z-20 flex items-center justify-between">
            <div class="flex items-center">
                <button @click="isNavOverlay()"
                    class="p-2 ml-3 rounded-full hover:bg-yellow-400 inline-block cursor-pointer">
                    <MenuIcon fillColor="bg-black" :size="26" />
                </button>
                <div class="mx-2"></div>
                <Link :href="route('landing-page.index')" class="flex items-center justify-center mr-10 cursor-pointer">
                <img class="" width="80" height="120" src="/images/logos/footer-logo.jpg" alt="">
                <h2 class="hidden md:block text-xl font-medium text-black">Dashboard</h2>
                </Link>
            </div>

            <div class="flex items-center z-30 px-6">
                    <Icon class="ml-1 mr-4" name="carbon:send-alt" color="#161724" size="24" />
                    <Icon class="mr-5" name="bx:message-detail" color="#161724" size="24" />
                    <div class="relative">
                        <button 
                        class="mt-1"
                        @click="showMenu = !showMenu"
                        >
                            <img
                                class="rounded-full"
                                width="33"
                                src="https://picsum.photos/id/83/300/320"
                             />
                        </button>

                        <div
                            v-if="showMenu"
                            id="PopMenu"
                            class="absolute bg-white rounded-lg py-1.5 w-[200px] shadow-xl border top-[43px] -right-2"
                        >
                            <NuxtLink
                            @click="showMenu = false"
                            class="flex items-center justify-start py-3 px-2 hover:bg-gray-100 cursor-pointer"
                            >
                                <AccountLockOpen size="20" />
                                <span class="pl-2 font-semibold text-sm">Profile</span>
                            </NuxtLink>
                            <div
                            class="flex items-center justify-start py-3 px-1.5 hover:bg-gray-100 border-t cursor-pointer"
                            >
                                <Logout size="20" />
                                <Link :href="route('logout')" method="post" as="button" class="pl-2 font-semibold text-sm">Log out</Link>
                            </div>
                        </div>
                    </div>
                </div>
        </div>




        <div v-if="width > 639">
            <div v-if="$page.url === usePage().url" id="SideNav" :class="[
                !openSideNav ? 'w-[70px]' : 'w-[240px]',
            ]" class="h-screen bg-black">
            <!-- primary color -->
            <!-- bg-[#F4E3B4] -->
                <ul :class="[!openSideNav ? 'p-2' : 'pb-2']" class="-mt-0.5 w-full">
                    <Link href="route('landing-page.index')">
                    <SideNavItem :openSideNav="openSideNav" iconString="Home" />
                    </Link>
                    <div class="border-b border-b-gray-700 my-2.5"></div>
                    <Link :href="route('categories-favorites.index')">
                        <SideNavItem :openSideNav="openSideNav" iconString="Category" />
                    </Link>
                    <Link :href="route('menus-list.index')">
                        <SideNavItem :openSideNav="openSideNav" iconString="Menus" />
                    </Link>
                    <Link :href="route('users.index')">
                        <SideNavItem :openSideNav="openSideNav" iconString="Users" />
                    </Link>
                    <Link :href="route('address.index')">
                        <SideNavItem :openSideNav="openSideNav" iconString="Address" />
                    </Link>
                </ul>
            </div>
        </div>


        <!-- OVERLAY NAV SECTION -->
        <div @click="openSideNavOverlay = false" class="bg-black bg-opacity-70 fixed z-50 w-full h-screen" :class="
            openSideNavOverlay
                ? 'animate__animated animate__fadeIn animate__faster'
                : 'hidden z-[-1]'
        " />
        <div id="SideNavOverlay" ref="sideNavOverlay" class="h-screen fixed z-50 bg-black w-[240px]" :class="
            openSideNavOverlay
                ? 'animate__animated animate__slideInLeft animate__faster'
                : 'animate__animated animate__slideOutLeft animate__faster'
        ">
            <!-- <div class="flex items-center">
                <button @click="isNavOverlay()" class="p-2 ml-3 rounded-full hover:bg-yellow-400 cursor-pointer">
                    <MenuIcon fillColor="bg-black" :size="26" />
                </button>
                <div class="mx-2"></div>
                <Link :href="route('landing-page.index')" class="flex items-center justify-center cursor-pointer">
                <img width="80" height="120" src="/images/logos/footer-logo.jpg" alt="">
                </Link>
            </div> -->
            <ul class="w-full px-1 py-2 mt-2">
                <Link :href="route('landing-page.index')">
                <SideNavItem :openSideNav="true" iconString="Home" />
                </Link>
                <div class="border-b border-b-gray-700 my-2.5"></div>
                <Link :href="route('categories-favorites.index')">
                    <SideNavItem :openSideNav="openSideNav" iconString="Category" />
                </Link>
                <Link :href="route('menus-list.index')">
                    <SideNavItem :openSideNav="openSideNav" iconString="Menus" />
                </Link>
                <Link :href="route('users.index')">
                    <SideNavItem :openSideNav="openSideNav" iconString="Users" />
                </Link>
                <Link :href="route('address.index')">
                    <SideNavItem :openSideNav="openSideNav" iconString="Address" />
                </Link>
            </ul>
        </div>
        <!-- OVERLAY NAV SECTION END -->

        <div class="w-[100%] h-[calc(100vh-60px)] absolute right-0 top-[100px]" :class="{
            'w-[calc(100%-70px)]': !openSideNav,
            'w-[calc(100%-240px)]': openSideNav,
            'w-[100vw] xl:w-[calc(100%-80px)]': $page.url !== usePage().url,
            'w-[100vw]': width < 639
        }">
            <div class="h-screen bg-gray-200">
                <slot />
            </div>
        </div>
    </div>
</template>

<style>body {background:  #000000;}</style>