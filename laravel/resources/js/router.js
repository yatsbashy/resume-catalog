import Vue from 'vue';
import VueRouter from 'vue-router';

// Components
import ResumeList from './pages/ResumeList.vue';
import Login from './pages/Login.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: ResumeList
  },
  {
    path: '/login',
    component: Login
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;
