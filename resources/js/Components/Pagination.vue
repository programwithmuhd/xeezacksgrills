<template>
    <div>
        <component
        :is="Link.url ? 'Link' : 'span'"
        v-for="Link in Links"
        :href="Link.url"
        v-html="Link.label"
        class="px-1"
        :class="{ 'text-gray-500': ! Link.url, 'font-bold': Link.active }"
        />
    </div>
</template>

<script>
    export default {
        props: {
            Links: Array
        }
    }
</script>