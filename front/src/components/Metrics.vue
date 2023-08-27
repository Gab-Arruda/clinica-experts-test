<script setup>
import { ref, onMounted, computed, watch } from 'vue';
// import axios from 'axios';

const app_metrics = ref({});

const props = defineProps({
  app_metrics: {
    type: Object,
    required: true
  }
})

</script>

<template>
    <section class="my-4">
        <ul class="flex flex-row flex-wrap items-top justify-center">
            <li class="flex m-4">
                <img src="../assets/link.png" alt="link-icon" class="w-6 h-6 mt-2">
                <div class="flex flex-col justify-top  w-[100px]">
                    <span class="text-center font-bold text-3xl">{{ props.app_metrics.links_amount }}</span>
                    <span class="text-center font-bold text-slate-500">Links</span>
                </div>
            </li>
            <li class="flex m-4">
                <img src="../assets/view.png" alt="view-icon" class="w-6 h-6 mt-2">
                <div class="flex flex-col justify-between  max-w-[100px]">
                    <span class="text-center font-bold text-3xl">{{ props.app_metrics.requisitions_amount }}</span>
                    <span class="text-center font-bold text-slate-500">All time views</span>
                </div>
            </li>
            <li class="flex m-4">
                <img src="../assets/30-days.png" alt="30-days-icon" class="w-6 h-6 mt-2">
                <div class="flex flex-col justify-between  max-w-[100px]">
                    <span class="text-center font-bold text-3xl">{{ props.app_metrics.requisitions_this_month }}</span>
                    <span class="text-center font-bold text-slate-500">Views this month</span>
                </div>
            </li>
        </ul>
    </section>
</template>

<style scoped>

</style>
