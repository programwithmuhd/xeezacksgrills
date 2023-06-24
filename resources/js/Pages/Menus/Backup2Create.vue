<script setup>
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import {ref, toRefs, computed } from 'vue'
import ArrowLeftIcon from 'vue-material-design-icons/ArrowLeft.vue';

defineProps({ errors: Object })

// const form = useForm({
//     category_id: null,
//     name: '',
//     slug: '',
//     description: '',
//     price: '',
//     image: '',
// });

// const submit = () => {
//     form.post(route('menus-list.index'))
// }


let category_id = ref()
let name = ref('')
let slug = ref('')
let description = ref('')
let price = ref('')
let image = ref('')
let error = ref({
    category_id:null,
    name: null,
    slug: null,
    description: null,
    price: null,
    image: null,
})

const submit = () => {
    let err = false

    error.value.category_id = null
    error.value.name = null
    error.value.slug = null
    error.value.description = null
    error.value.price = null
    error.value.image = null

    if (!category_id.value) {
        error.category_id = 'Please enter a category';
        err = true
    }
    if (!name.value) {
        error.name = 'Please enter menu name';
        err = true
    }
    if (!slug.value) {
        error.slug = 'Please enter slug name';
        err = true
    }
    if (!description.value) {
        error.description = 'Please enter menu description';
        err = true
    }
    if (!price.value) {
        error.price = 'Please enter menu price';
        err = true
    }
    if (!image.value) {
        error.image = 'Please enter menu image';
        err = true
    }

    if (err) {
        return
    }

    let data = new FormData()

    data.append('category_id', category_id.value)
    data.append('name', name.value)
    data.append('slug', slug.value)
    data.append('description', description.value)
    data.append('price', price.value)
    data.append('image', image.value)

    router.post('/menus-list', data)

}
const getImage = (e) => image.value = e.target.files[0]

</script>

<template>
    <Head title="Food Menus List" />
    <DashboardLayout>
        <div class="flex items-center justify-between px-6 bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Add New Menu</h2>
            </div>
            <Link :href="route('menus-list.index')">
                <ArrowLeftIcon size="30" />
            </Link>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">


            <div class="bg-white max-w-xl px-8 py-8">
                <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                    <form @submit.prevent="submit">
                        <div class="py-4 w-full">
                            <select name="category_id" v-model="form.category_id" class="mt-1 block 
                                w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                                ">
                                <template v-for="category in $page.props.category_menus" :key="category.id">
                                    <option selected :value="category.id">{{ category.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Menu name" />
                                <TextInput v-model="form.name" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Slug" />
                                <TextInput v-model="form.slug" type="text" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        <div class="py-4">
                            <InputLabel class="" value="Description" />
                            <TextArea v-model="form.description" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Price" />
                                <TextInput v-model="form.price" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Image" />
                                <TextInput type="file" @input="form.image = $event.target.files[0]"  class="mt-1 block w-full" required />
                            </div>
                        </div>
                        
                        <div class="py-4">
                            <button type="submit"
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