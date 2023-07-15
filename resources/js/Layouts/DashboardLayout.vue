<script setup>
import { ref, onMounted } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import SideNavItem from '../Components/SideNavItem.vue'
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import MagnifyIcon from 'vue-material-design-icons/Magnify.vue';

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
                <h2 class="text-xl font-medium text-black">Dashboard</h2>
                </Link>
            </div>

            <!-- <div class="w-[600px] md:block hidden">
                <div class="rounded-full flex items-center bg-yellow-400 ">
                    <input type="text" class="
                                        form-control
                                        block
                                        w-full
                                        px-5
                                        py-1.5
                                        text-base
                                        font-normal
                                        text-gray-200
                                        bg-[#F4E3B4]
                                    placeholder-gray-400
                                    bg-clip-padding
                                    border
                                    border-solid
                                    border-l-gray-700
                                    border-y-gray-700
                                    rounded-l-full
                                    transition
                                    ease-in-out
                                    m-0
                                    border-transparent
                                    focus:ring-0
                                " placeholder="Search" />
                    <MagnifyIcon class="mx-6" fillColor="black" :size="23" />
                </div>
            </div> -->
            <div>
                <img class="rounded-full mx-8" width="80" height="120" src="/images/logos/footer-logo.jpg">
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
                    <SideNavItem :openSideNav="openSideNav" iconString="Users" />
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
                <SideNavItem :openSideNav="openSideNav" iconString="Users" />
            </ul>
        </div>
        <!-- OVERLAY NAV SECTION END -->

        <div class="w-[100%] h-[calc(100vh-60px)] absolute right-0 top-[100px]" :class="{
            'w-[calc(100%-70px)]': !openSideNav,
            'w-[calc(100%-240px)]': openSideNav,
            'w-[100vw] xl:w-[calc(100%-80px)]': $page.url !== usePage().url,
            'w-[100vw]': width < 639
        }">
            <div class="h-screen bg-white">
                <slot />
            </div>
        </div>
    </div>
</template>

<style>body {background:  #000000;}</style>