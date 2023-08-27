<script setup>
import { ref } from 'vue';
import axios from 'axios';

defineProps({
  add_modal: {
    type: Boolean,
    required: true
  }
})
const emit = defineEmits(['addLink','setAddModal', 'getLinksList']);

const slug = ref('');
const url = ref('');
const description = ref('');

const addLink = () => {
    const data = {
        slug: slug.value,
        url: url.value,
        description: description.value
    };
    
    axios.post('http://localhost:8000/api/links/', data)
    .then(response => {
        emit('setAddModal');
        emit('getLinksList');
  });
}

</script>

<template>
    <section v-if="add_modal" class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white rounded shadow-lg">
            <div class="border-b px-4 py-2">
                <h3 class="font-bold">Add new link</h3>
            </div>
            <form action="" class="p-3">
                <div class="flex flex-wrap p-2 items-center">
                    <label for="slug" class="my-1 mx-2 font-bold text-slate-500">Slug</label>
                    <input type="text" name="slug" v-model="slug" placeholder="Insert slug here" 
                    class="my-1 mx-2 py-1 px-2 outline-none bg-slate-200 text-slate-500 grow">
                </div>
                <div class="flex flex-wrap p-2 items-center">
                    <label for="url" class="my-1 mx-2 font-bold text-slate-500">URL</label>
                    <input type="text" name="url" v-model="url" placeholder="Insert URL here"
                    class="my-1 mx-2 py-1 px-2 outline-none bg-slate-200 text-slate-500 grow">
                </div>
                <div class="flex flex-wrap p-2 items-center">
                    <label for="description" class="my-1 mx-2 font-bold text-slate-500">Description</label>
                    <input type="text" name="description" v-model="description" placeholder="Insert description here"
                    class="my-1 mx-2 py-1 px-2 outline-none bg-slate-200 text-slate-500 grow  w-48 sm:w-48">
                </div>
            </form>
            <div class="flex justify-center items-center p-3">
                <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mx-3" @click="$emit('setAddModal')">Cancelar</button>
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white mx-3" @click="addLink()">Adicionar</button>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
