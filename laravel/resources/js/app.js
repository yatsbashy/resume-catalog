import './bootstrap';
import Vue from 'vue';
import router from './router';
import store from './store';
import App from './App.vue';

const createVm = async () => {
  await store.dispatch('auth/currentUser');

  new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App />'
  });
};

createVm();
