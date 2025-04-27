import { createWebHistory, createRouter } from 'vue-router'

import LoginPage from './pages/Login.vue'
import IndexPage from './pages/Index.vue'

const routes = [
  { path: '/', component: IndexPage },
  { path: '/login', component: LoginPage },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router