<template>
  <div class="flex flex-col gap-4 mt-12 max-h-[400px] overflow-y-auto" v-auto-animate>
    <template v-if="!loading">
      <Room
        v-for="room in list"
        :room="room"
        :days="days"
        @select="(room) => $emit('pickRoom', room)"
      />
    </template>
  </div>
</template>

<script setup lang="ts">
import Room from '@/components/Room.vue'

defineEmits(['pickRoom']);
const { list, loading, days } = defineProps(['list', 'loading', 'days'])

</script>