<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

import {
  NumberField,
  NumberFieldContent,
  NumberFieldDecrement,
  NumberFieldIncrement,
  NumberFieldInput,
} from '@/components/ui/number-field'

import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'


import type { DateRange } from 'reka-ui'
import { cn } from '@/lib/utils'

import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { RangeCalendar } from '@/components/ui/range-calendar'
import {
  CalendarDate,
  DateFormatter,
  getLocalTimeZone,
} from '@internationalized/date'
import { CalendarIcon } from 'lucide-vue-next'
import { type Ref, ref } from 'vue'



const df = new DateFormatter('en-US', {
  dateStyle: 'medium',
})

const value = ref({
  start: undefined,
  end: undefined,
}) as Ref<DateRange>
</script>

<template>
  <div class="flex min-h-svh flex-col items-center justify-center gap-6 bg-background p-6 md:p-10">
    <Card class="w-[600px]">
      <CardHeader>
        <CardTitle>Бронирование номера</CardTitle>
        <CardDescription>Выберите дату заезда и количество гостей</CardDescription>
      </CardHeader>
      <CardContent>
        <form>
          <div class="grid grid-cols-2 items-center w-full gap-8">
            <FormField name="dob">
            <FormItem class="flex flex-col">
              <FormLabel>Даты заезда и выезда</FormLabel>
              <Popover>
                <PopoverTrigger as-child>
                  <Button variant="outline" :class="cn(
                    'justify-start text-left font-normal',
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
                    v-model="value"
                    initial-focus
                    :number-of-months="2"
                    @update:start-value="(startDate) => value.start = startDate"
                  />
                </PopoverContent>
              </Popover>
            </FormItem>
          </FormField>

            <NumberField id="age" :default-value="1" :min="0">
              <Label for="age">Количество гостей</Label>
              <NumberFieldContent>
                <NumberFieldDecrement />
                <NumberFieldInput />
                <NumberFieldIncrement />
              </NumberFieldContent>
            </NumberField>
          </div>
        </form>
      </CardContent>

      <CardFooter class="flex justify-end px-6">
        <Button>Забронировать</Button>
      </CardFooter>
    </Card>
  </div>

</template>
