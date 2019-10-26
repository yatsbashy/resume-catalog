import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

// Components
import ResumeList from './pages/ResumeList.vue';
import Login from './pages/Login.vue';
import NotFound from './pages/errors/NotFound.vue';
import SystemError from './pages/errors/System.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: ResumeList,
    meta: { requiresAuth: true }
  },
  {
    path: '/login',
    component: Login,
    beforeEnter(to, from, next) {
      // ログインしていればトップページに移動する
      if (store.getters['auth/isLoggedIn']) {
        next('/');
      } else {
        next();
      }
    }
  },
  {
    path: '/500',
    component: SystemError
  },
  {
    path: '*',
    component: NotFound
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

router.beforeEach((to, from, next) => {
  // ログインしていなければログインページに移動する
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters['auth/isLoggedIn']) {
      next({
        path: '/login'
      });
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
