<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import {ref, toRefs, computed } from 'vue'

defineProps({ errors: Object })

let category_id = ref('')
let name = ref('')
let slug = ref('')
let image = ref('')
let description = ref('')
let price = ref('')
let error = ref({
    category_id: null,
    name: null,
    slug: null,
    image: null,
    description: null,
    price: null,
})

const addMenu = () => {
    let err = false

    error.value.category_id = null
    error.value.name = null
    error.value.slug = null
    error.value.image = null
    error.value.description = null
    error.value.price = null

    if (!category_id.value) {
        error.value.category_id = 'Please enter category';
        err = true
    }
    if (!name.value) {
        error.value.name = 'Please enter menu name';
        err = true
    }
    if (!slug.value) {
        error.value.slug = 'Please enter menu slug';
        err = true
    }
    if (!image.value) {
        error.value.image = 'Please add menu image';
        err = true
    }
    if (!description.value) {
        error.value.description = 'Please add menu description';
        err = true
    }
    if (!price.value) {
        error.value.price = 'Please add menu price';
        err = true
    }

    if (err) {
        return
    }

    let data = new FormData()

    data.append('category_id', category_id.value)
    data.append('name', name.value)
    data.append('slug', slug.value)
    data.append('image', image.value)
    data.append('description', description.value)
    data.append('price', price.value)

    router.post('/menus-list/create', data)

}

const getImage = (e) => image.value = e.target.files[0]

</script>

<template>
    <Head title="Food Menus List" />
    <DashboardLayout>
        <div class="flex items-start bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Add New Menu</h2>
            </div>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">


            <div class="bg-white max-w-xl px-8 py-8">
                <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                    <form @submit.prevent="addMenu">
                        <div class="py-4 w-full">
                            <InputLabel class="" value="Category" />
                            <select v-model="category_id" class="mt-1 block 
                                            w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                                            " name="country">
                                <option selected value="Soup">Soup</option>
                                <option value="Salad">Salad</option>
                            </select>
                            <span v-if="error.category_id" class="text-red-500">{{ error.category_id }}</span>
                        </div>
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Menu name" />
                                <TextInput v-model="name" type="text" class="mt-1 block w-full" required />
                                <span v-if="error.name" class="text-red-500">{{ error.name }}</span>
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Slug" />
                                <TextInput v-model="slug" type="text" class="mt-1 block w-full" required />
                                <span v-if="error.slug" class="text-red-500">{{ error.slug }}</span>
                            </div>
                        </div>
                        <div class="py-4">
                            <InputLabel class="" value="Description" />
                            <TextArea v-model="description" type="text" class="mt-1 block w-full" required />
                            <span v-if="error.description" class="text-red-500">{{ error.description }}</span>
                        </div>
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Price" />
                                <TextInput v-model="price" type="text" class="mt-1 block w-full" required />
                                <span v-if="error.price" class="text-red-500">{{ error.price }}</span>
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Image" />
                                <TextInput @change="getImage" type="file" class="mt-1 block w-full" required />
                                <span v-if="error.image" class="text-red-500">{{ error.image }}</span>
                                <span v-if="errors && errors.image" class="text-red-500">{{ errors.image }}</span>
                            </div>
                        </div>
                        
                        <div class="py-4">
                            <button
                                class="w-full bg-yellow-400 px-3 py-3 font-bold text-lg rounded-lg shadow-sm cursor-pointer">
                                Add Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>