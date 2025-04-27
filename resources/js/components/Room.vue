<template>
  <Alert class="flex flex-col">
    <AlertTitle class="w-full">
      <div class="flex justify-between">
        <span>Супериор</span>
        <span class="text-muted-foreground">400 руб / ночь</span>
      </div>
    </AlertTitle>
    <AlertDescription>
      Двухместный номер с одной двуспальной или двумя отдельными кроватями и возможностью разместить дополнительное
      спальное место.
      <div class="mt-6 flex gap-4 items-baseline justify-between w-full">
        <h2 class="text-xl font-semibold tracking-tight text-card-foreground">2000 руб</h2>
        <Button @click="selectRoom(1)" size="sm" class="cursor-pointer">
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
const { room } = defineProps(['room'])

function selectRoom(room) {
  emit('select', room)
}

</script>