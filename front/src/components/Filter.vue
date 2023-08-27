<script setup>

defineEmits(['setOrderType','setFilterModal'])

</script>

<template>
    <section class="flex items-center justify-center mt-6">
        <img src="../assets/two-arrow.png" alt="two-arrow-icon" class="w-8 h-8 mx-4 cursor-pointer" @click="$emit('setOrderType')">
        <img src="../assets/filter.png" alt="filter-icon" class="w-8 h-8 mx-4 cursor-pointer" @click="$emit('setFilterModal')">
    </section>
</template>

<style scoped>

</style>
