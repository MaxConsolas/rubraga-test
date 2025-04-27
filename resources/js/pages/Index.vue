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
            <DateRangeInput
              @select-range="(value) => bookRange = value"
            />

            <GuestCountInput
              @update="(value) => guestCount = value"
            />
            
          </div>
        </form>

        <RoomList
          :list="[1,2,3,4,5]"
          @select=""
        />
      </CardContent>
    </Card>
  </div>

</template>


<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'

import { defineComponent, reactive, type Ref, ref, watch } from 'vue'
import type { DateRange } from 'reka-ui'

import RoomList from '@/components/RoomList.vue'
import DateRangeInput from '@/components/DateRangeInput.vue'
import GuestCountInput from '@/components/GuestCountInput.vue'

const bookRange = reactive<DateRange>({
  start: undefined,
  end: undefined,
})

const guestCount = ref(1)
const loading = ref(false)

const rooms = reactive([])

watch([bookRange, guestCount], async ([newRange, newGuestCount]) => {
  if (newRange.start && newRange.end && newGuestCount) {
    loading.value = true
    try {
      const res = await fetch('https://yesno.wtf/api')
      answer.value = (await res.json()).answer
    } catch (error) {
      answer.value = 'Error! Could not reach the API. ' + error
    } finally {
      loading.value = false
    }
  }
})
</script>
