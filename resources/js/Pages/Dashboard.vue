<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { toRefs, computed } from 'vue'

</script>

<template>
    <Head title="Food Menus" />

    <DashboardLayout>
        <div class="flex items-start bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Dashboard</h2>
            </div>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8 grid place-items-center">
            <h2 class="text-4xl font-bold px-4 py-[22px]">Dashboard</h2>
        </div>
    </DashboardLayout>
</template>