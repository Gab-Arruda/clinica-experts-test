<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  selected_link: {
    type: Object,
    required: true
  }
})
const emit = defineEmits(['setEditModal', 'getLinksList']);

const slug = ref('');
const url = ref('');
const description = ref('');
const show_skeleton = ref(false);

const editLink = () => {
    show_skeleton.value = true;
    const data = {
        slug: slug.value,
        url: url.value,
        description: description.value
    };

    axios.put('http://localhost:8000/api/links/'+props.selected_link.id, data)
    .then(response => {
        emit('setEditModal');
        show_skeleton.value = false;
        emit('getLinksList');
        console.log('editou o link: ' + props.selected_link.slug);
    });
}

onMounted(() => {
  slug.value = props.selected_link.slug;
  url.value = props.selected_link.url;
  description.value = props.selected_link.description;
})

</script>

<template>
    <section class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50">
        <div v-if="!show_skeleton" class="bg-white rounded shadow-lg w-full max-w-screen-md mx-2">
            <div class="border-b px-4 py-2">
                <h3 class="font-bold">Edit link: {{ this.selected_link.slug }}</h3>
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
                <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mx-3" @click="$emit('setEditModal')">Cancelar</button>
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white mx-3" @click="editLink()">Editar</button>
            </div>
        </div>
        <div v-if="show_skeleton" class="flex justify-center items-center w-full">
            <img src="../assets/loading.png" alt="loading" class="h-20 w-20">
        </div>
    </section>
</template>

<style scoped>

</style>
