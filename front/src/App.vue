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
import Skeleton from 'primevue/skeleton';

const links_list = ref([]);
const order_type = ref('desc');
const filter_column = ref('created_at');
const add_modal = ref(false);
const filter_modal = ref(false);
const edit_modal = ref(false);
const selected_link = ref({});
const app_metrics = ref({});
const user_ip = ref('');
const list_skeleton = ref(false);
const metrics_skeleton = ref(false);

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

const getLinksList = (search) => {
  list_skeleton.value = true;
  console.log('list_skeleton: '+list_skeleton.value);
  axios.get('http://localhost:8000/api/links/', { params: {filterByColumn : filter_column.value, filterOrderType: order_type.value, searchString: search}})
  .then(response => {
    links_list.value = response.data;
    list_skeleton.value = false;
    console.log('list_skeleton: '+list_skeleton.value);
  });
}

const getMetrics = () => {
  metrics_skeleton.value = true;
  axios.get('http://localhost:8000/api/links/metrics')
  .then(response => {
    app_metrics.value = response.data;
    metrics_skeleton.value = false;
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
    <Header @setAddModal="setAddModal" @getLinksList="getLinksList"></Header>
    <body class="px-16 app bg-slate-200 grow">        
      <Metrics v-if="!metrics_skeleton" :app_metrics="app_metrics"></Metrics>
      <div v-if="metrics_skeleton" class="flex justify-center items-center my-4 sm:h-[116px] sm:w-full">
        <div class="h-[324px] w-[247px] sm:h-20 sm:w-[460px] bg-slate-300 rounded-md"></div>
      </div>
      <Filter v-if="links_list.length && !list_skeleton" @setOrderType="setOrderType" @setFilterModal="setFilterModal"></Filter>
      <LinksList v-if="links_list.length && !list_skeleton" :links_list="links_list" :user_ip="user_ip" @setEditModal="setEditModal"
      @getLinksList="getLinksList" @getMetrics="getMetrics"></LinksList>
      <div v-if="links_list.length == 0 && !list_skeleton" class="flex items-center justify-center">
        <img src="./assets/no-results.png" alt="no-results-icon" class="w-36 h-36 mx-1"/>
      </div>
      <div v-if="list_skeleton" class="flex justify-center items-center my-4 sm:h-auto sm:w-full">
        <div class="h-[142px] w-[247px] sm:h-[200px] sm:w-[760px] bg-slate-300 rounded-md"></div>
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
