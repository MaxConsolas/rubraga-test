<template>
  <div class="flex flex-col gap-4 mt-12 max-h-[400px] overflow-y-auto">
    <Room
      v-for="room in list"
      :room="room"
    />
  </div>
</template>

<script setup lang="ts">
import Room from '@/components/Room.vue'

const { list } = defineProps(['list'])
</script>