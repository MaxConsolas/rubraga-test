<template>
  <FormField name="dates">
    <FormItem class="flex flex-col">
      <FormLabel>Даты заезда и выезда</FormLabel>
      <Popover>
        <PopoverTrigger as-child>
          <Button variant="outline" :class="cn(
            'justify-start text-left font-normal cursor-pointer',
            !value && 'text-muted-foreground',
          )">
            <CalendarIcon class="mr-2 h-4 w-4" />
            <template v-if="value.start">
              <template v-if="value.end">
                {{ df.format(value.start.toDate(getLocalTimeZone())) }} - {{
                  df.format(value.end.toDate(getLocalTimeZone())) }}
              </template>

              <template v-else>
                {{ df.format(value.start.toDate(getLocalTimeZone())) }}
              </template>
            </template>
            <template v-else>
              Выберите даты
            </template>
          </Button>
        </PopoverTrigger>

        <PopoverContent class="w-auto p-0">
          <RangeCalendar
            :isDateUnavailable="(date) => (date.add({ days: 1 }).toDate('Asia/Yekaterinburg') < new Date())"
            locale="ru-RU"
            initial-focus
            :number-of-months="2"
            @update:model-value="selectRange"
            />
            <!-- @update:start-value="selectStart"
            @update:end-value="selectEnd" -->
        </PopoverContent>
      </Popover>
    </FormItem>
  </FormField>
</template>

<script setup lang="ts">
import { defineComponent, type Ref, ref, reactive } from 'vue'
import { Button } from '@/components/ui/button'

import {
  FormField,
  FormItem,
  FormLabel,
} from '@/components/ui/form'

import { CalendarIcon } from 'lucide-vue-next'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { RangeCalendar } from '@/components/ui/range-calendar'
import { cn } from '@/lib/utils'
import type { DateRange } from 'reka-ui'

import {
  DateFormatter,
  getLocalTimeZone,
} from '@internationalized/date'

const emit = defineEmits(['selectRange'])

const df = new DateFormatter('ru-RU', {
  dateStyle: 'medium',
})

const value = ref<DateRange>({
  start: undefined,
  end: undefined,
})

function selectRange(range) {
  value.value = range
  emit('selectRange', range)
}

</script>

