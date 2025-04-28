import axios from 'axios';
import store from './store';

axios.interceptors.request.use(config => {
  const user = JSON.parse(localStorage.getItem('user'));
  if (user && user.token) {
    config.headers.Authorization = `Bearer ${user.token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});

axios.interceptors.response.use(response => {
  return response;
}, error => {
  console.log(error)
  if (error.response.status === 401) {
    store.dispatch('auth/logout');
    window.location = '/login';
  }
  return Promise.reject(error);
});