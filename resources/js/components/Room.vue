<template>
  <Alert class="flex flex-col">
    <AlertTitle class="w-full">
      <div class="flex justify-between">
        <span>{{ room.type.name }}</span>
        <span class="text-muted-foreground">{{ room.price }} руб / ночь</span>
      </div>
    </AlertTitle>
    <AlertDescription>
      {{ room.type.description }}
      <div class="mt-6 flex gap-4 items-baseline justify-between w-full">
        <h2 class="text-xl font-semibold tracking-tight text-card-foreground">{{ room.price * (days ?? 1) }} руб</h2>
        <Button @click="selectRoom(room.id)" size="sm" class="cursor-pointer">
          Забронировать
        </Button>
      </div>
    </AlertDescription>
  </Alert>
</template>

<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Button } from '@/components/ui/button'

const emit = defineEmits(['select'])
const { room, days } = defineProps(['room', 'days'])

function selectRoom(room) {
  emit('select', room)
}

</script>