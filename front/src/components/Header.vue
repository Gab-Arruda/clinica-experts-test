<script setup>
import { ref } from 'vue';
defineEmits(['setAddModal', 'getLinksList'])
const search = ref('');
</script>

<template>
    <header class="flex flex-wrap items-center justify-center bg-white py-4">
      <img src="../assets/search-interface-symbol.png" alt="search-icon" class="w-6 h-6 mx-6 my-2 cursor-pointer hidden sm:block" @click="$emit('getLinksList', search)">
      <input type="text" placeholder="Search or paste URL"  v-model="search" v-on:keyup.enter="$emit('getLinksList', search)"
      class="outline-none bg-slate-200 text-slate-500 mx-2 py-1 px-2 w-4/5 sm:w-2/4">
      <img src="../assets/plus-grey.png" alt="plus-icon" class="w-6 h-6 mx-6 my-2 cursor-pointer" @click="$emit('setAddModal')">
    </header>
</template>

<style scoped>

</style>
