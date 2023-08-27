<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const emit = defineEmits(['setFilterModal','setColumn']);
const selected_column = ref('');

const columns = ["slug", "url", "description", "counter", "created_at", "updated_at"];
</script>

<template>
    <section class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white rounded shadow-lg">
            <div class="border-b px-4 py-2">
                <h3 class="font-bold">Filter links</h3>
            </div>
            <fieldset action="" class="p-3">
                <div v-for="column in columns" :key="column" class="flex items-center">
                    <input type="radio" :id="column" name="column" :value="column" v-model="selected_column"/>
                    <label :for="column" class="text-slate-500 font-bold mx-1">{{ column.replace("_", " ") }}</label>
                </div>
            </fieldset>
            <div class="flex justify-center items-center p-3">
                <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mx-3" @click="$emit('setFilterModal')">Cancelar</button>
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white mx-3" @click="$emit('setColumn', selected_column)">Filtrar</button>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
