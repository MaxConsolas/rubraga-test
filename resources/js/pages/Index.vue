<template>
  <div class="flex min-h-svh flex-col items-center justify-center gap-6 bg-background p-6 md:p-10">
    <Card class="w-[600px]">
      <CardHeader>
        <CardTitle>
          <div class="flex justify-between align-baseline items-center">
            <div>Добро пожаловать, {{ store.state.user.user.name }}</div>
            <Button variant="link" class="cursor-pointer" @click="logout">Выход</Button>
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
          :loading="loading"
          :list="rooms"
          :days="getDaysBetween(bookRange.start, bookRange.end)"
          @pickRoom="pickRoom"
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
import axios from 'axios';
import { parseDate } from '@internationalized/date';
import { useRouter } from 'vue-router'

import RoomList from '@/components/RoomList.vue'
import DateRangeInput from '@/components/DateRangeInput.vue'
import GuestCountInput from '@/components/GuestCountInput.vue'
import { useDateFormatter } from 'reka-ui';
import { toast } from 'vue-sonner'

import { useStore } from 'vuex';

const store = useStore();
const router = useRouter()

const bookRange = ref<DateRange>({
  start: undefined,
  end: undefined,
})

const guestCount = ref(1)
const loading = ref(false)

const rooms = ref([])

function getDaysBetween(start, end) {
  if (!start || !end) return 1;
  const jsStart = start.toDate('Asia/Yekaterinburg');
  const jsEnd = end.toDate('Asia/Yekaterinburg');

  const diffTime = jsEnd.getTime() - jsStart.getTime();
  return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
}

async function pickRoom(roomId) {
  if (!bookRange.value.start || !bookRange.value.end || !guestCount.value) return;
  console.log(roomId)
  try {
      const res = await axios.post('api/book', {
        start_date: `${bookRange.value.start.year}-${bookRange.value.start.month}-${bookRange.value.start.day}`,
        end_date: `${bookRange.value.end.year}-${bookRange.value.end.month}-${bookRange.value.end.day}`,
        guest_count: guestCount.value,
        room_id: roomId
      })
      const data = (await res.data)
      rooms.value = data
      toast('Успешно', {
        description: "Вы забронировали номер",
      })
      fetchRooms(bookRange.value, guestCount.value)
    } catch (error) {
      console.log(error)
    } finally {
      loading.value = false
    }
}

function logout() {
  store.dispatch('logout')
  router.push('/login')
}

async function fetchRooms(range, guestCount) {
  try {
    loading.value = true
    const res = await axios.post('api/rooms/available', {
      start_date: `${range.start.year}-${range.start.month}-${range.start.day}`,
      end_date: `${range.end.year}-${range.end.month}-${range.end.day}`,
      guest_count: guestCount,
    })
    const data = (await res.data)
    rooms.value = data
  } catch (error) {
    console.log(error)
  } finally {
    loading.value = false
  }
}

watch([bookRange, guestCount], async ([newRange, newGuestCount]) => {
  if (newRange.start && newRange.end && newGuestCount) {
    fetchRooms(newRange, newGuestCount)
  }
})
</script>
