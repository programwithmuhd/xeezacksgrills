<script setup>
import { Head, Link } from '@inertiajs/vue3';
import XeezacksgrillLayout from '@/Layouts/XeezacksgrillLayout.vue';
import Slider from "@/Pages/Slider.vue";


</script>

<template>
    <Head title="About" />

    <XeezacksgrillLayout>
        <Slider />
        <div class="w-full bg-white h-auto">
            <div class="max-w-7xl mx-auto">
                <div class="flex-col gap-16 px-16 py-16 sm:flex-col md:flex-col lg:flex-row flex-auto flex justify-between">
                    <div class="sm:w-full lg:w-1/5 text-4xl font-semibold text-gray-900">About Us</div>
                    <div class="sm:w-full lg:w-4/5">
                        <p class="text-2xl text-gray-900 leading-8">
                            At Xeezacks Grill House, we are passionate about delivering a dining experience that transcends mere sustenance. Our mission is to ignite your taste buds with the sizzling symphony of perfectly grilled beef, the oceanic delight of succulent fish, and the comforting warmth of rejuvenating tea.
                        </p>
                        <p class="text-2xl text-gray-900 leading-8 py-4">
                            Rooted in tradition, Xeezacks Grill House is a celebration of culinary craftsmanship and the rich heritage of flavors. Founded with a vision to offer an oasis of taste, our journey began with a simple idea: to create a haven for food enthusiasts seeking quality, taste, and connection.
                        </p>
                        <p class="text-2xl text-gray-900 leading-8 py-4">
                            We take pride in mastering the art of grilling. Each piece of beef and fish we grill embodies our dedication to authenticity and excellence. Our skilled chefs meticulously prepare each cut, infusing it with a symphony of spices that dance upon your palate, leaving you craving more.
                        </p>
                        <p class="text-2xl text-gray-900 leading-8 py-4">
                            We source the finest ingredients to ensure that every dish tells a story of flavor and freshness. Our beef is handpicked for its marbling and tenderness, guaranteeing a melt-in-your-mouth experience. The fish we select comes from sustainable sources, reflecting our commitment to the environment and responsible consumption. And our teas? They're carefully curated to whisk you away on a journey of tranquility with each soothing sip.
                        </p>
                        <p class="text-2xl text-gray-900 leading-8 py-4">
                            We are not just a grill house; we are a destination for those seeking an unforgettable dining experience. Our commitment to quality, flavor, and your satisfaction is unwavering. With every bite, you'll taste our dedication to the craft, our respect for tradition, and our unwavering passion for food.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </XeezacksgrillLayout>
</template>