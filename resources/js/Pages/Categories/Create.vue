<script setup>
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import {ref, reactive, toRefs, computed } from 'vue'
import ArrowLeftIcon from 'vue-material-design-icons/ArrowLeft.vue';

defineProps({ errors: Object })

const form = reactive({
    name: '',
    slug: '',
});

const submit = () => {
    router.post(route('categories-favorites.index'),form)
}

</script>

<template>
    <Head title="Food Menus List" />
    <DashboardLayout>
        <div class="flex items-center justify-between px-6 bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Add New Category</h2>
            </div>
            <Link :href="route('categories-favorites.index')">
                <ArrowLeftIcon size="30" />
            </Link>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">


            <div class="bg-white sm:max-w-full md:max-w-4xl mx-auto px-6 py-8">
                <div class="flex-col sm:flex-col md:flex-row flex items-center justify-between gap-10">
                    <form class="mx-auto" @submit.prevent="submit">
                        <div class="py-4">
                                <InputLabel class="" value="Category name" />
                                <TextInput v-model="form.name" type="text" class="mt-1 block w-full" />
                            </div>
                            <div v-if="errors.name" v-text="errors.name" class="mt-2 text-red-500 text-xs"></div>
                            <div class="py-4">
                                <InputLabel class="" value="Slug" />
                                <TextInput v-model="form.slug" type="text" class="mt-1 block w-full" />
                            </div>
                            <div v-if="errors.slug" v-text="errors.slug" class="mt-2 text-red-500 text-xs"></div>
                        <div class="py-4">
                            <button type="submit"
                                class="w-full bg-yellow-400 px-3 py-3 font-bold text-lg rounded-lg shadow-sm cursor-pointer">
                                Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>