import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './axios'
import store from './store';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'

createApp(App)
  .use(router)
  .use(store)
  .use(autoAnimatePlugin)
  .mount('#app');