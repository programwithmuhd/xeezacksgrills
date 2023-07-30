<script setup>
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import { ref, toRefs, computed } from 'vue'
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import ArrowLeftIcon from 'vue-material-design-icons/ArrowLeft.vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
// import DeleteUserForm from 'vendor/laravel/breeze/stubs/inertia-react/resources/js/Pages/Profile/Partials/DeleteUserForm';

const props = defineProps({ user: Object })

const showConfirmDeleteUserModal = ref(false);

const confirmDeleteUser = () => {
    showConfirmDeleteUserModal.value = true;
}

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    mobile_number: props.user.mobile_number,
    email: props.user.email,
    password: props.user.password,
})

const updateUser = () => {
    router.post(`/users/${props.user.id}`, {
        _method: 'put',
        first_name: form.first_name,
        last_name: form.last_name,
        mobile_number: form.mobile_number,
        email: form.email,
        password: form.password,
    })
}

// const showConfirmDeleteMenuModal = ref(false)

// const confirmDeleteMenu = () => {
//     showConfirmDeleteMenuModal.value = true;
// }

// const closeModal = () => {
//     showConfirmDeleteMenuModal.value = false;
// }

// const deleteMenu = (id) => {
//     form.delete(route('menus-list.destroy', id), {
//         onSuccess: () => closeModal()
//     });
// }

</script>

<template>
    <Head title="Food Menus List" />
    <DashboardLayout>
        {{ props.user.first_name }}
        <div class="flex items-center justify-between px-6 bg-white">
            <div class="">
                <h2 class="text-xl font-bold px-4 py-[22px]">Edit User</h2>
            </div>
            <Link :href="route('users.index')">
                <ArrowLeftIcon size="30" />
            </Link>
        </div>
        <div class="bg-gray-200 px-6 pt-16 pb-8">

            <div class="bg-white sm:max-w-full md:max-w-4xl mx-auto px-6 py-8">
                <div class="flex-col sm:flex-col md:flex-row flex justify-between gap-10">
                    <form class="mx-auto" @submit.prevent="updateUser">
                        <div class="py-4 w-full">
                            <div class="py-4">
                                <InputLabel class="" value="First name" />
                                <TextInput v-model="form.first_name" type="text" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Last name" />
                                <TextInput v-model="form.last_name" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div class="py-4">
                                <InputLabel class="" value="Mobile Number" />
                                <TextInput v-model="form.mobile_number" type="text" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        <div class="py-4">
                            <InputLabel class="" value="Email" />
                            <TextInput v-model="form.email" type="email" class="mt-1 block w-full" required />
                        </div>
                        <div class="flex item-center gap-5">
                            <div class="py-4">
                                <InputLabel class="" value="Password" />
                                <TextInput v-model="form.password" type="password" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-5">
                            <div class="py-4">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Update
                                </button>
                            </div>
                            <div class="py-4">
                                <button @click="confirmDeleteUser" 
                                    class="inline-flex 
                                    items-center 
                                    px-4 
                                    py-2 
                                    bg-red-600 
                                    border 
                                    border-transparent 
                                    rounded-md font-semibold 
                                    text-xs 
                                    text-white 
                                    uppercase 
                                    tracking-widest 
                                    hover:bg-red-500 
                                    active:bg-red-700 
                                    focus:outline-none 
                                    focus:ring-2 
                                    focus:ring-red-500 
                                    focus:ring-offset-2 
                                    transition 
                                    ease-in-out 
                                    duration-150
                                    "
                                    >Delete
                                </button>
                                <Modal :show="showConfirmDeleteUserModal" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-slate-800">Are you sure you want delete this user?</h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="deleteUser(user.id)">Delete</DangerButton>
                                            <SecondaryButton @close="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                                <!-- <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete
                                </button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>