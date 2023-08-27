<script setup>
defineProps({
    filter_modal: {
    type: Boolean,
    required: true
  }
})
defineEmits(['setFilterModal','setColumn'])
</script>

<template>
    <section v-if="filter_modal" class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white rounded shadow-lg w-1/3">
            <div class="border-b px-4 py-2">
                <h3 class="font-bold">Filter links</h3>
            </div>
            <form action="" class="p-3">
                <input type="text" placeholder="Inputs do form vão aqui">
            </form>
            <div class="flex justify-center items-center p-3">
                <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mx-3" @click="$emit('setFilterModal')">Cancelar</button>
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white mx-3" @click="$emit('setColumn', 'slug')">Filtrar</button>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
