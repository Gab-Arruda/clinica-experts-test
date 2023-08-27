<script setup>
defineEmits(['setEditModal','deleteLink'])
defineProps({
  links_list: {
    type: Object,
    required: true
  }
})
</script>

<template>
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
            <img src="../assets/bar-chart.png" alt="bar-chart-icon" class="w-6 h-6 mx-1"/>
          </div>
          <img src="../assets/editing.png" alt="edit-icon" class="w-6 h-6 mx-1 cursor-pointer" @click="$emit('setEditModal', link)"/>
          <img src="../assets/trash.png" alt="trash-icon" class="w-6 h-6 mx-1 cursor-pointer" @click="$emit('deleteLink', link)"/>
        </div>
      </li>
    </ul>
  </section>
</template>

<style scoped>

</style>
