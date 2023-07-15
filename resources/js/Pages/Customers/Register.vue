<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    first_name: '',
    last_name: '',
    mobile_number: '',
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('customer-register.store'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="first_name" value="First name" />

                <TextInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required
                    autocomplete="first_name" />

                <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div class="mt-4">
                <InputLabel value="Last name" />

                <TextInput type="text" class="mt-1 block w-full" v-model="form.last_name" required
                    autocomplete="last_name" />

                <InputError class="mt-2" :message="form.errors.last_name" />
            </div>
            <div class="mt-4">
                <InputLabel value="Mobile number" />

                <TextInput type="text" class="mt-1 block w-full" v-model="form.mobile_number" required
                    autocomplete="mobile_number" />

                <InputError class="mt-2" :message="form.errors.mobile_number" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('customer-login.index')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>