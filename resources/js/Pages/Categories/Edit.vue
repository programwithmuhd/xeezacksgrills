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
import TrashIcon from 'vue-material-design-icons/Delete.vue'

const props = defineProps({ category: Object })

const form = useForm({
    name: props.category.name,
    slug: props.category.slug,
})

const updateCategory = () => {
    router.post(`/categories-favorites/${props.category.id}`, {
        _method: 'put',
        name: form.name,
        slug: form.slug,
    })
}

const showConfirmDeleteCategoryModal = ref(false)

const confirmDeleteCategory = () => {
    showConfirmDeleteCategoryModal.value = true;
}

const closeModal = () => {
    showConfirmDeleteCategoryModal.value = false;
}

const deleteCategory = (id) => {
    form.delete(route('categories-favorites.destroy', id), {
        onSuccess: () => closeModal()
    });
}

</script>

<template>
    <Head title="Food Menus List" />
    <DashboardLayout>
        <div class="flex items-center justify-between px-6 bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Edit Category</h2>
            </div>
            <Link :href="route('categories-favorites.index')">
            <ArrowLeftIcon size="30" />
            </Link>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">

            <div class="bg-white sm:max-w-full md:max-w-4xl mx-auto px-6 py-8">
                <div class="flex justify-end">
                    <div class="-mt-4">
                        <TrashIcon class="cursor-pointer text-red-600" @click="confirmDeleteCategory" size="46" />
                        <Modal :show="showConfirmDeleteCategoryModal" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-slate-800">Are you sure you want to delete
                                    this category?</h2>
                                <div class="mt-6 flex space-x-4">
                                    <DangerButton @click="deleteCategory(category.id)">Delete</DangerButton>
                                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                </div>
                            </div>
                        </Modal>
                    </div>
                </div>
                <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                    <form class="mx-auto" @submit.prevent="updateCategory">
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Category name" />
                                <TextInput v-model="form.name" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Slug" />
                                <TextInput v-model="form.slug" type="text" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="py-4">
                                <button class="inline-flex items-center px-4 py-2 
                                        bg-green-600 border border-transparent 
                                        rounded-md font-semibold text-xs text-white 
                                        uppercase tracking-widest 
                                        hover:bg-green-500 active:bg-green-700 
                                        focus:outline-none focus:ring-2 
                                        focus:ring-green-500 focus:ring-offset-2 
                                        transition ease-in-out duration-150
                                    ">
                                    Update Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>