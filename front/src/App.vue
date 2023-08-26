<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted, computed, watch } from 'vue';
import axios from 'axios';
// import HelloWorld from './components/HelloWorld.vue'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'

const links_list = ref([]);
const app_metrics = ref({});
const order_type = ref('desc');
const filter_column = ref('created_at');

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

const setOrderType = () => {
  order_type.value = order_type.value == 'asc' ? 'desc' : 'asc';
  getLinksList();
}

const getLinksList = () => {
  axios.get('http://localhost:8000/api/links/', { params: {filterByColumn : filter_column.value, filterOrderType: order_type.value}})
  .then(response => {
    links_list.value = response.data;
  });
}

onMounted(() => {
  // Lista de links
  axios.get('http://localhost:8000/api/links/', { params: {filterByColumn : "created_at", filterOrderType: "desc"}})
  .then(response => {
    links_list.value = response.data;
  });

  // Métricas do app
  axios.get('http://localhost:8000/api/links/metrics')
  .then(response => {
    app_metrics.value = response.data;
  });
})

</script>

<template>
  <main class="app bg-slate-200 flex flex-col justify-between h-screen">
    <Header></Header>
    <body class="px-16">        
      <section class="my-8">
        <ul class="flex flex-row flex-wrap items-center justify-around">
          <li class="flex m-4">
            <img src="./assets/link.png" alt="link-icon" class="w-6 h-6">
            <div class="flex flex-col max-w-[100px]">
              <span class="text-center font-bold text-3xl">{{ app_metrics.links_amount }}</span>
              <span class="text-center font-bold text-slate-500">Links</span>
            </div>
          </li>
          <li class="flex m-4">
            <img src="./assets/view.png" alt="view-icon" class="w-6 h-6">
            <div class="flex flex-col max-w-[100px]">
              <span class="text-center font-bold text-3xl">{{ app_metrics.requisitions_amount }}</span>
              <span class="text-center font-bold text-slate-500">All time views</span>
            </div>
          </li>
          <li class="flex m-4">
            <img src="./assets/30-days.png" alt="30-days-icon" class="w-6 h-6">
            <div class="flex flex-col max-w-[100px]">
              <span class="text-center font-bold text-3xl">{{ app_metrics.requisitions_this_month }}</span>
              <span class="text-center font-bold text-slate-500">Views this month</span>
            </div>
          </li>
        </ul>
      </section>
      <section class="flex items-center justify-center">
        <img src="./assets/two-arrow.png" alt="two-arrow-icon" class="w-8 h-8 mx-4 cursor-pointer" @click="setOrderType()">
        <img src="./assets/filter.png" alt="filter-icon" class="w-8 h-8 mx-4 cursor-pointer" @click="editLink(link)">
      </section>
      <section class="links-list my-4">
        <ul class="flex-col my-4">
          <li v-for="link in links_list" :key="link.id" class="flex justify-between flex-wrap items-center my-3 bg-white px-8 py-4 rounded-md">
            <div class="flex flex-col">
              <span class="font-bold text-xl">{{ link.description }}</span>
              <span class="font-bold text-sky-400/100">{{ link.slug }}</span>
            </div>
            <div class="flex">
              <div class="flex mx-1">
                <span class="counter text-xl">{{ link.counter }}</span>
                <img src="./assets/bar-chart.png" alt="bar-chart-icon" class="w-6 h-6 mx-1"/>
              </div>
              <img src="./assets/editing.png" alt="edit-icon" class="w-6 h-6 mx-1 cursor-pointer" @click="editLink(link)"/>
              <img src="./assets/trash.png" alt="trash-icon" class="w-6 h-6 mx-1 cursor-pointer" @click="removeLink(link)"/>
            </div>
          </li>
        </ul>
      </section>
    </body>
    <Footer></Footer>
  </main>
</template>

<style scoped>

</style>
