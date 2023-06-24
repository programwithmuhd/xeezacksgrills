<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, usePage } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col items-center pt-6 bg-[#F4E3B4]">
        <div>
            <Link href="/">
                <img class="w-40 fill-current text-gray-500" src="/images/logos/footer-logo.jpg" alt="">
            </Link>
        </div>

        <div
            class="w-full max-w-[400px] mt-6 px-6 py-4 bg-[#F4E3B4] border border-gray-300 overflow-hidden rounded-sm"
        >
            <slot />
        </div>

        <div v-if="$page.url === '/login'" class="w-[400px]">
            <div class="text-center text-sm text-gray-600 font-bold py-4">New to Xeezacks Grills?</div>
            <div class="w-full border border-gray-500 bg-gray-200 text-sm font-extrabold p-2 hover:bg-gray-300 text-center">
                <Link :href="route('register')">
                    Create your Xeezacks grills account
                </Link>
            </div>
        </div>
    </div>
</template>
