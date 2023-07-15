<script setup>
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { ref, toRefs, computed } from 'vue'
import ArrowLeftIcon from 'vue-material-design-icons/ArrowLeft.vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({ menu: Object, image: String })

const form = useForm({
    category_id: props.menu.category_id,
    name: props.menu.name,
    slug: props.menu.slug,
    description: props.menu.description,
    price: props.menu.price,
    image: null,
})

const updateMenu = () => {
    router.post(`/menus-list/${props.menu.id}`, {
        _method: 'put',
        category_id: form.category_id,
        name: form.name,
        slug: form.slug,
        description: form.description,
        price: form.price,
        image: form.image,
    })
}

const showConfirmDeleteMenuModal = ref(false)

const confirmDeleteMenu = () => {
    showConfirmDeleteMenuModal.value = true;
}

const closeModal = () => {
    showConfirmDeleteMenuModal.value = false;
}

const deleteMenu = (id) => {
    form.delete(route('menus-list.destroy', id), {
        onSuccess: () => closeModal()
    });
}

</script>

<template>
    <Head title="Food Menus List" />
    <DashboardLayout>
        <div class="flex items-center justify-between px-6 bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Edit Menu</h2>
            </div>
            <Link :href="route('menus-list.index')">
            <ArrowLeftIcon size="30" />
            </Link>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">

            <div class="bg-white sm:max-w-full md:max-w-4xl mx-auto px-6 py-8">
                <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                    <form class="mx-auto" @submit.prevent="updateMenu">
                        <div class="py-4 w-full">
                            <select v-model="form.category_id" class="mt-1 block 
                            w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                            ">
                                <template v-for="(category, index) in $page.props.category_menus" :key="category.id">
                                    <option :value="category.id">{{ category.name }}</option>
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
                                <TextInput type="file" @input="form.image = $event.target.files[0]"
                                    class="mt-1 block w-full" />
                            </div>
                        </div>
                        <div class="py-4">
                            <div class="w-32 h-32">
                                <img :src="image" alt="">
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-5">
                            <div class="py-4">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Update Menu
                                </button>
                            </div>
                            <div class="py-4">
                                <button type="submit" @click="confirmDeleteMenu" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete
                                </button>
                                <Modal :show="showConfirmDeleteMenuModal" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-slate-800">Are you sure you want to delete
                                            this food menu?</h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="deleteMenu(menu.id)">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>