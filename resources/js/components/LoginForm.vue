<script setup lang="ts">
import { Button } from '@/components/ui/button'

import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'

import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

const router = useRouter();
const store = useStore();

const user = ref({
  email: '',
  password: ''
});
const error = ref(null);

const handleSubmit = async () => {
  try {
    await store.dispatch('auth/login', user.value);
    router.push('/');
  } catch (err) {
    error.value = err.response?.data?.error || 'Login failed';
  }
};
</script>

<template>
  <div class="flex flex-col gap-6">
    <form>
      <div class="flex flex-col gap-6">
        <div class="flex flex-col items-center gap-2">
          <h1 class="text-xl font-bold">
            l
          </h1>
          <div class="text-center text-sm">
            Нет аккаунта?
            <router-link to="/register" class="underline underline-offset-4">Регистрация</router-link>
          </div>
        </div>
        <div class="flex flex-col gap-6">
          <div class="grid gap-2">
            <Label html-for="email">Email</Label>
            <Input
              id="email"
              type="email"
              placeholder="m@example.com"
              required
            />
          </div>
          <div class="grid gap-2">
            <Label html-for="email">Пароль</Label>
            <Input
              id="password"
              type="password"
              placeholder=""
              required
            />
          </div>
          <Button type="submit" class="w-full">
            Войти
          </Button>
        </div>
      </div>
    </form>
  </div>
</template>
