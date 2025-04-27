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
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

const errors = ref({
  name: null,
  email: null,
  password: null,
  password_confirmation: null
});

const isLoading = ref(false);
const registerError = ref(null);

const handleSubmit = async () => {

  isLoading.value = true;
  registerError.value = null;

  try {
    await store.dispatch('auth/register', user.value);
    
    // После успешной регистрации автоматически логиним пользователя
    await store.dispatch('auth/login', {
      email: user.value.email,
      password: user.value.password
    });
    
    router.push('/dashboard');
  } catch (error) {
    if (error.response?.data?.errors) {
      // Обработка ошибок валидации с сервера
      errors.value = { ...errors.value, ...error.response.data.errors };
    } else {
      registerError.value = error.response?.data?.message || 'Registration failed';
    }
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <div class="flex flex-col gap-6">
    <form>
      <div class="flex flex-col gap-6">
        <div class="flex flex-col items-center gap-2">
          <h1 class="text-xl font-bold">
            Регистрация
          </h1>
          <div class="text-center text-sm">
            Есть аккаунт?
            <router-link to="/login" class="underline underline-offset-4">Войти</router-link>
          </div>
        </div>
        <div class="flex flex-col gap-6">
          <div class="grid gap-2">
            <Label html-for="name">Имя</Label>
            <Input
              id="name"
              type="name"
              v-model="user.name"
              placeholder="Maxim"
              required
            />
          </div>
          <div class="grid gap-2">
            <Label html-for="email">Email</Label>
            <Input
              id="email"
              type="email"
              v-model="user.email"
              placeholder="m@example.com"
              required
            />
          </div>
          <div class="grid gap-2">
            <Label html-for="password">Password</Label>
            <Input
              id="password"
              type="password"
              v-model="user.password"
              placeholder=""
              required
            />
          </div>
          <Button type="submit" class="w-full">
            Зарегистрироваться
          </Button>
        </div>
      </div>
    </form>
  </div>
</template>
