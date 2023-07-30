<template>
    <div>
        <li
        :class="[!openSideNav ? 'py-4 px-1' : 'flex items-center p-2']"
        class="text-white text-lg font-semibold text-center hover:bg-yellow-400 rounded-lg cursor-pointer"
          >
          <div :class="[!openSideNav ? 'w-full flex justify-center' : '']">
              <component :is="icon" />
          </div>
          <div :class="[!openSideNav ? '' : 'mt-1 ml-4 py-2']">
              <span v-if="openSideNav">{{ iconString }}</span>
          </div>
        </li>
    </div>
</template>

<script setup>
  import { defineProps, toRefs } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import Home from 'vue-material-design-icons/Home.vue';
  import FolderPlayOutline from 'vue-material-design-icons/FolderPlayOutline.vue';
  import Users from 'vue-material-design-icons/ImageMultiple.vue';
  import ThumbUpOutline from 'vue-material-design-icons/ThumbUpOutline.vue';
  import History from 'vue-material-design-icons/History.vue';
  import CartIcon from 'vue-material-design-icons/Cart.vue';

  const props = defineProps({
    openSideNav: Boolean,
    iconString: String,
  })

  const { openSideNav, iconString } = toRefs(props)

  let icon = null

  if (iconString.value === 'Home') icon = Home
  if (iconString.value === 'Category') icon = FolderPlayOutline
  if (iconString.value === 'Menus') icon = CartIcon
  if (iconString.value === 'Users') icon = Users
  if (iconString.value === 'Address') icon = History
</script>