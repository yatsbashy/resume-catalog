import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

// Components
import ResumeList from './pages/ResumeList.vue';
import ResumeDetail from './pages/ResumeDetail.vue';
import Profile from './components/Profile.vue';
import Skills from './components/Skills.vue';
import Works from './components/Works.vue';
import Login from './pages/Login.vue';
import About from './pages/About.vue';
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
    path: '/users/:id',
    component: ResumeDetail,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        redirect: 'profile'
      },
      {
        path: 'profile',
        component: Profile
      },
      {
        path: 'skills',
        component: Skills
      },
      {
        path: 'works',
        component: Works
      }
    ]
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
    path: '/about',
    component: About
  },
  {
    path: '/404',
    component: NotFound
  },
  {
    path: '/500',
    component: SystemError
  },
  {
    path: '*',
    redirect: '/404'
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
