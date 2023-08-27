<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted, computed, watch } from 'vue';
import axios from 'axios';
// import HelloWorld from './components/HelloWorld.vue'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import Metrics from './components/Metrics.vue'
import Filter from './components/Filter.vue'
import LinksList from './components/LinksList.vue'
import AddModal from './components/AddModal.vue'
import EditModal from './components/EditModal.vue'
import FilterModal from './components/FilterModal.vue'

const links_list = ref([]);
const order_type = ref('desc');
const filter_column = ref('created_at');
const add_modal = ref(false);
const filter_modal = ref(false);
const edit_modal = ref(false);
const selected_link = ref({});
const app_metrics = ref({});
const user_ip = ref('');

const setAddModal = () => {
  // abre modal de filtrar
  add_modal.value = !add_modal.value;
}

const setFilterModal = () => {
  // abre modal de filtrar
  filter_modal.value = !filter_modal.value;
}

const setEditModal = (link) => {
  // abre modal de editar
  if(link) {
    selected_link.value = link;
  }
  edit_modal.value = !edit_modal.value;
}

const setOrderType = () => {
  order_type.value = order_type.value == 'asc' ? 'desc' : 'asc';
  getLinksList();
}

const setColumn = (value) => {
  filter_column.value = value;
  filter_modal.value = !filter_modal.value;
  getLinksList();
}

const getLinksList = () => {
  axios.get('http://localhost:8000/api/links/', { params: {filterByColumn : filter_column.value, filterOrderType: order_type.value}})
  .then(response => {
    links_list.value = response.data;
  });
}

const getMetrics = () => {
  axios.get('http://localhost:8000/api/links/metrics')
  .then(response => {
    app_metrics.value = response.data;
  });
}

const getUserIP = () => {
  axios.get('https://api.ipify.org?format=json')
  .then(response => {
    user_ip.value = response.data.ip;
  });
}

onMounted(() => {
  getLinksList();
  getMetrics();
  getUserIP();
})
</script>

<template>
  <main class="app bg-slate-200 flex flex-col justify-between h-screen">
    <Header @setAddModal="setAddModal"></Header>
    <body class="px-16 app bg-slate-200 grow">        
      <Metrics :app_metrics="app_metrics"></Metrics>
      <Filter v-if="links_list.length" @setOrderType="setOrderType" @setFilterModal="setFilterModal"></Filter>
      <LinksList v-if="links_list.length" :links_list="links_list" :user_ip="user_ip" @setEditModal="setEditModal"
      @getLinksList="getLinksList" @getMetrics="getMetrics"></LinksList>
      <div v-if="links_list.length == 0" class="flex items-center justify-center h-full">
        <img src="./assets/no-results.png" alt="no-results-icon" class="w-36 h-36 mx-1"/>
      </div>
    </body>
    <AddModal v-if="add_modal" @setAddModal="setAddModal"
    @getLinksList="getLinksList" @getMetrics="getMetrics"></AddModal>
    <EditModal v-if="edit_modal" :selected_link="selected_link" @setEditModal="setEditModal" @getLinksList="getLinksList"></EditModal>
    <FilterModal v-if="filter_modal" @setColumn="setColumn" @setFilterModal="setFilterModal"></FilterModal>
    <Footer></Footer>
  </main>
</template>

<style scoped>

</style>
