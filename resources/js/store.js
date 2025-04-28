import { createStore } from 'vuex';
import authStore from './auth/auth.store';

const store = createStore(authStore)
export default store
