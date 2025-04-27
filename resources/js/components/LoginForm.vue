<script setup lang="ts">
import { Button } from '@/components/ui/button'

import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { GalleryVerticalEnd } from 'lucide-vue-next'
</script>

<template>
  <div class="flex flex-col gap-6">
    <form>
      <div class="flex flex-col gap-6">
        <div class="flex flex-col items-center gap-2">
          <h1 class="text-xl font-bold">
            Welcome
          </h1>
          <div class="text-center text-sm">
            Don't have an account?
            <a href="#" class="underline underline-offset-4">
              Sign up
            </a>
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
          <Button type="submit" class="w-full">
            Login
          </Button>
        </div>
      </div>
    </form>
  </div>
</template>
