<template>
<div class="flex">
    <template v-for="(link, key) in Links" :key="key">
        <div
            class="mb-1 mr-1 px-4 py-3 text-gray-900 text-sm leading-4 border rounded" 
            v-if="link.url === null" 
            v-html="link.label"
         />
        <Link
            class="
                    mb-1 
                    mr-1 
                    px-4 
                    py-3 
                    text-gray-900 
                    text-sm 
                    leading-4 
                    border 
                    rounded 
                    focus:text-black 
                    focus:border-black 
                    hover:bg-white"
            :class="{ 'bg-yellow-400' : link.active} "
            v-else 
            :href="link.url" 
            v-html="link.label"
        />
    </template>
</div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { ref } from 'vue';

defineProps({
    Links: Array
})
</script>