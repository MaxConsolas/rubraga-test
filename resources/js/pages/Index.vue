<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Label } from '@/components/ui/label'

import {
  NumberField,
  NumberFieldContent,
  NumberFieldDecrement,
  NumberFieldIncrement,
  NumberFieldInput,
} from '@/components/ui/number-field'

import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'

import {
  FormField,
  FormItem,
  FormLabel,
} from '@/components/ui/form'


import type { DateRange } from 'reka-ui'
import { cn } from '@/lib/utils'

import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { RangeCalendar } from '@/components/ui/range-calendar'
import {
  DateFormatter,
  getLocalTimeZone,
} from '@internationalized/date'
import { CalendarIcon } from 'lucide-vue-next'
import { type Ref, ref } from 'vue'

const df = new DateFormatter('ru-RU', {
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
        <CardTitle>
          <div class="flex justify-between align-baseline items-center">
            <div>Добро пожаловать, sandakov2013@yandex.ru</div>
            <Button variant="link" class="cursor-pointer">Выход</Button>
          </div>
        </CardTitle>
      </CardHeader>
    </Card>
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
                    v-model="value"
                    :isDateUnavailable="(date) => (date.add({ days: 1 }).toDate('Asia/Yekaterinburg') < new Date())"
                    locale="ru-RU"
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
                <NumberFieldDecrement class="cursor-pointer" />
                <NumberFieldInput />
                <NumberFieldIncrement class="cursor-pointer" />
              </NumberFieldContent>
            </NumberField>
          </div>
        </form>


        <div class="flex flex-col gap-6 mt-12">
          <Alert class="flex flex-col" v-for="room in [1,2,3,4]">
            <AlertTitle class="w-full">
              <div class="flex justify-between">
                <span>Супериор</span>
                <span class="text-muted-foreground">400 руб / ночь</span></div>
              </AlertTitle>
            <AlertDescription>
              Двухместный номер с одной двуспальной или двумя отдельными кроватями и возможностью разместить дополнительное спальное место.
              <div class="justify-self-end mt-4 flex gap-4 justify-center items-baseline">
                <h4 class="font-semibold text-black">Итого: 2000 руб</h4>
                <Button size="sm" class="cursor-pointer">
                  Забронировать
                </Button>
              </div>
            </AlertDescription>
          </Alert>

        </div>

      </CardContent>
    </Card>
  </div>

</template>
