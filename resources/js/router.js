import { createWebHistory, createRouter } from 'vue-router'

import LoginPage from './pages/Login.vue'
import RegisterPage from './pages/Register.vue'
import IndexPage from './pages/Index.vue'

const routes = [
  { path: '/', component: IndexPage },
  { path: '/login', component: LoginPage },
  { path: '/register', component: RegisterPage },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('user');

  if (authRequired && !loggedIn) {
    return next('/login');
  }

  next();
});

export default router