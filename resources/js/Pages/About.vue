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
                    <div class="sm:w-full lg:w-4/5 text-2xl text-gray-900 leading-8">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos hic quibusdam dolore consequatur obcaecati eius repudiandae doloremque itaque laborum architecto aperiam voluptatem accusantium ducimus quisquam, autem harum maiores earum explicabo commodi eaque, amet illo iure. Optio vitae molestiae in itaque odit ex nesciunt, corrupti consectetur nisi maiores labore impedit similique alias doloribus natus aliquam voluptatibus aspernatur sed omnis ea soluta praesentium nulla explicabo? Tempore accusamus dolore amet molestiae nulla nisi qui? Doloremque sed dolor provident nobis, rem corrupti nam voluptatibus?
                    </div>
                </div>
            </div>
        </div>
    </XeezacksgrillLayout>
</template>