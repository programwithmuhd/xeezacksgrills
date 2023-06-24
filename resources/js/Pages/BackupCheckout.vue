<script setup>
import { reactive, ref, computed } from 'vue'
// import { Head, Link, router } from '@inertiajs/vue3';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Slider from "@/Pages/Slider.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { useCartStore } from '@/store/cart'
import { storeToRefs } from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

defineProps({
})



const total = computed(() => {
    let total = 0
    cart.value.forEach(c => { total += c.price })
    if (total > 0) {
        return total.toFixed(2) * 100
    }
    return 0
})


const form = reactive({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    state: '',
    city: '',
    amount: '',
    addr1: '',
    amount: total,
});

// Paystack codes goes here

let submit = () => {
    router.post('/checkout', form, {
        // total_decimal: total,
        items: cart.value
    })
}




</script>

<template>
    <Head title="Food Menus" />

    <GuestLayout>

        <Head title="Register" />
        <form @submit.prevent="submit">
            <div class="flex item-center gap-5">
                <div class="py-4">
                    <InputLabel class="" value="First name" />
                    <TextInput v-model="form.first_name" type="text" class="mt-1 block w-full" required />
                </div>
                <div class="py-4">
                    <InputLabel class="" value="Last name" />
                    <TextInput v-model="form.last_name" type="text" class="mt-1 block w-full" required />
                </div>
            </div>
            <div class="flex item-center gap-5">
                <div class="py-4">
                    <InputLabel class="" value="Email Addess" />
                    <TextInput v-model="form.email" type="text" class="mt-1 block w-full" required />
                </div>
                <div class="py-4">
                    <InputLabel class="" value="Phone number" />
                    <TextInput v-model="form.phone" type="text" class="mt-1 block w-full" required />
                </div>
            </div>
            <div class="flex item-center gap-5">
                <div class="py-4 w-full">
                    <InputLabel class="" value="State" />
                    <select v-model="form.state" class="mt-1 block 
                                    w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                                    " name="state">
                        <option selected value="Kaduna">Kaduna</option>
                    </select>
                </div>
                <div class="py-4 w-full">
                    <InputLabel class="" value="District" />
                    <select v-model="form.city" class="mt-1 block 
                                    w-full border-gray-300 focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm
                                    " name="country">
                        <option selected value="United Kingdom">Ali Akilu</option>
                        <option value="Unguwar Rimi">Unguwar Rimi</option>
                        <option value="Malali">Malali</option>
                        <option value="Unguwar Sarki">Unguwar Sarki</option>
                        <option value="Badarawa">Badarawa</option>
                        <option value="Unguwar Dosa">Unguwar Dosa</option>
                        <option value="Sabon Kawo">Sabon Kawo</option>
                    </select>
                </div>
            </div>
            <div class="py-4">
                <InputLabel class="" value="Enter Address line" />
                <TextArea v-model="form.addr1" type="text" class="mt-1 block w-full" required />
            </div>
            <div class="py-4">
                <TextInput v-model="form.amount" type="hidden" class="mt-1 block w-full" required />
            </div>
            <div class="py-4">
                <button class="w-full bg-yellow-400 px-3 py-3 font-bold text-lg rounded-lg shadow-sm cursor-pointer">
                    Place order
                </button>
            </div>
        </form>
    </GuestLayout>
</template>