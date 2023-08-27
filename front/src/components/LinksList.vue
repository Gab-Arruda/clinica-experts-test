<script setup>
import axios from 'axios';
const emit =defineEmits(['setEditModal', 'getLinksList', 'getMetrics'])
defineProps({
  links_list: {
    type: Object,
    required: true
  }
})

const deleteLink = (link) => {
    axios.delete('http://localhost:8000/api/links/'+link.id)
    .then(response => {
        emit('getLinksList');
        emit('getMetrics');
    });
}
</script>

<template>
  <section class="links-list my-4">
    <ul class="flex-col my-4">
      <li v-for="link in links_list" :key="link.id" class="flex flex-col sm:flex-row justify-between flex-wrap items-start
      sm:items-center my-3 bg-white px-8 py-4 rounded-md">
        <div class="flex flex-col">
          <span class="font-bold text-xl">{{ link.description }}</span>
          <span class="font-bold text-sky-400/100">{{ link.slug }}</span>
        </div>
        <div class="flex my-4">
          <div class="flex mx-1">
            <span class="counter text-xl">{{ link.counter }}</span>
            <img src="../assets/bar-chart.png" alt="bar-chart-icon" class="w-6 h-6 mx-1"/>
          </div>
            <img src="../assets/editing.png" alt="edit-icon" class="w-6 h-6 mx-1 cursor-pointer" @click="$emit('setEditModal', link)"/>
            <img src="../assets/trash.png" alt="trash-icon" class="w-6 h-6 mx-1 cursor-pointer" @click="deleteLink(link)"/>
        </div>
      </li>
    </ul>
  </section>
</template>

<style scoped>

</style>
