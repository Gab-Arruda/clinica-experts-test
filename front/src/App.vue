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

const addLink = () => {
  // chamar rota para adicionar um link
  add_modal.value = !add_modal.value;
  // atualizar o links_list
}

const editLink = (link) => {
  // chamar rota para editar o link
  edit_modal.value = !edit_modal.value;
  console.log('editou o link: ' + link.url);
  // atualizar o links_list
}

const deleteLink = (link) => {
  // chamar rota para deletar o link
  console.log('delete o link: ' + link.url);
  // atualizar o links_list
}

const setAddModal = () => {
  // abre modal de filtrar
  add_modal.value = !add_modal.value;
  console.log('setAddModal: ' + add_modal.value);
}

const setFilterModal = () => {
  // abre modal de filtrar
  filter_modal.value = !filter_modal.value;
  console.log('setFilterModal: ' + filter_modal.value);
}

const setEditModal = (link) => {
  // abre modal de editar
  if(link) {
    selected_link.value = link;
  }
  edit_modal.value = !edit_modal.value;
  console.log('setEditModal: ' + edit_modal.value);
}

const setOrderType = () => {
  order_type.value = order_type.value == 'asc' ? 'desc' : 'asc';
  console.log('setOrderType: ' + order_type.value);
  getLinksList();
}

const setColumn = (value) => {
  filter_column.value = value;
  console.log('setColumn: ' + filter_column.value);
  filter_modal.value = !filter_modal.value;
  getLinksList();
}

const getLinksList = () => {
  axios.get('http://localhost:8000/api/links/', { params: {filterByColumn : filter_column.value, filterOrderType: order_type.value}})
  .then(response => {
    links_list.value = response.data;
  });
}

onMounted(() => {
  getLinksList();
})
</script>

<template>
  <main class="app bg-slate-200 flex flex-col justify-between h-screen">
    <Header @setAddModal="setAddModal"></Header>
    <body class="px-16 grow">        
      <Metrics></Metrics>
      <Filter @setOrderType="setOrderType" @setFilterModal="setFilterModal"></Filter>
      <LinksList :links_list="links_list" @setEditModal="setEditModal" @deleteLink="deleteLink"></LinksList>
    </body>
    <AddModal v-if="add_modal" @addLink="addLink" @setAddModal="setAddModal" @getLinksList="getLinksList"></AddModal>
    <EditModal v-if="edit_modal" :selected_link="selected_link" @setEditModal="setEditModal" @getLinksList="getLinksList"></EditModal>
    <FilterModal :filter_modal="filter_modal" @setColumn="setColumn" @setFilterModal="setFilterModal"></FilterModal>
    <Footer></Footer>
  </main>
</template>

<style scoped>

</style>
