<template>
  <NumberField id="age" :default-value="1" :min="1" @update:model-value="update">
    <Label for="age">Количество гостей</Label>
    <NumberFieldContent>
      <NumberFieldDecrement class="cursor-pointer" />
      <NumberFieldInput />
      <NumberFieldIncrement class="cursor-pointer" />
    </NumberFieldContent>
  </NumberField>
</template>

<script setup lang="ts">
import {
  NumberField,
  NumberFieldContent,
  NumberFieldDecrement,
  NumberFieldIncrement,
  NumberFieldInput,
} from '@/components/ui/number-field'

import { Label } from '@/components/ui/label'

const emit = defineEmits(['update'])

function update(value) {
  emit('update', value)
}

</script>