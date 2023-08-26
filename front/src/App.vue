<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted, computed, watch } from 'vue';
import axios from 'axios';
import HelloWorld from './components/HelloWorld.vue'

const links_list = ref([]);
const app_metrics = ref({});

const removeLink = (link) => {
  // chamar rota para deletar o link
  // atualizar o links_list
  console.log('deletou o link: ' + link.url);
}

const editLink = (link) => {
  // chamar rota para editar o link
  // atualizar o links_list
  console.log('editou o link: ' + link.url);
}

onMounted(() => {
  axios.get('http://localhost:8000/api/links/')
  .then(response => {
    links_list.value = response.data;
  });
  axios.get('http://localhost:8000/api/links/metrics')
  .then(response => {
    app_metrics.value = response.data;
  });
})

</script>

<template>
  <main class="app bg-slate-200">
    <header class="flex flex-col items-center justify-around bg-white py-4">
      <input type="text" class="bg-slate-200">
    </header>
    <body class="px-8">        
      <section class="my-8">
        <ul class="flex flex-row items-center justify-around">
          <li class="flex flex-col">
            <span class="text-center">{{ app_metrics.links_amount }}</span>
            <span>Links</span>
          </li>
          <li class="flex flex-col">
            <span class="text-center">{{ app_metrics.requisitions_amount }}</span>
            <span>Acessos totais</span>
          </li>
          <li class="flex flex-col">
            <span class="text-center">{{ app_metrics.requisitions_this_month }}</span>
            <span>Acessos esse mês</span>
          </li>
        </ul>
      </section>
      <section class="flex items-center justify-center">
        <img src="./assets/two-arrow.png" alt="two-arrow" class="w-8 h-8 mx-4 cursor-pointer">
        <img src="./assets/filter.png" alt="two-arrow" class="w-8 h-8 mx-4 cursor-pointer">
      </section>
      <section class="links-list my-4">
        <ul class="flex-col my-4">
          <li v-for="link in links_list" :key="link.id" class="flex justify-between flex-wrap items-center my-3 bg-white px-4 py-2 rounded-md">
            <div class="flex-col">
              <h1>{{ link.description }}</h1>
              <span>{{ link.slug }}</span>
            </div>
            <div>
              <button class="counter">{{ link.counter }}</button>
              <button class="delete" @click="editLink(link)">Editar</button>
              <button class="delete" @click="removeLink(link)">Deletar</button>
            </div>
          </li>
        </ul>
      </section>
    </body>
    <footer class="flex flex-col items-center justify-around bg-white py-4">
      <h4>Teste técnico Clínica Experts</h4>
    </footer>
  </main>
</template>

<style scoped>

</style>
