<template>
  <div class="container--small">
    <ul class="tab">
      <li class="tab__item" :class="{'tab__item--active': tab === 1 }" @click="tab = 1">ログイン</li>
      <li class="tab__item" :class="{'tab__item--active': tab === 2 }" @click="tab = 2">新規登録</li>
    </ul>
    <div class="panel" v-show="tab === 1">
      <form class="form" @submit.prevent="login">
        <div v-if="loginErrorMessages" class="errors">
          <ul v-if="loginErrorMessages.email">
            <li v-for="msg in loginErrorMessages.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="loginErrorMessages.password">
            <li v-for="msg in loginErrorMessages.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>
        <label for="login-email">メールアドレス</label>
        <input type="text" class="form__item" id="login-email" v-model="loginForm.email" />
        <label for="login-password">パスワード</label>
        <input type="password" class="form__item" id="login-password" v-model="loginForm.password" />
        <div class="form__button">
          <button type="submit" class="button button--inverse">ログイン</button>
        </div>
      </form>
    </div>
    <div class="panel" v-show="tab === 2">
      <form class="form" @submit.prevent="register">
        <div v-if="registerErrorMessages" class="errors">
          <ul v-if="registerErrorMessages.name">
            <li v-for="msg in registerErrorMessages.name" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrorMessages.email">
            <li v-for="msg in registerErrorMessages.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrorMessages.password">
            <li v-for="msg in registerErrorMessages.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>
        <label for="username">名前</label>
        <input type="text" class="form__item" id="username" v-model="registerForm.name" />
        <label for="email">メールアドレス</label>
        <input type="text" class="form__item" id="email" v-model="registerForm.email" />
        <label for="password">パスワード</label>
        <input type="password" class="form__item" id="password" v-model="registerForm.password" />
        <label for="password-confirmation">パスワード (確認)</label>
        <input
          type="password"
          class="form__item"
          id="password-confirmation"
          v-model="registerForm.password_confirmation"
        />
        <div class="form__button">
          <button type="submit" class="button button--inverse">新規登録</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    };
  },
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus,
      loginErrorMessages: state => state.auth.loginErrorMessages,
      registerErrorMessages: state => state.auth.registerErrorMessages
    })
  },
  methods: {
    async login() {
      await this.$store.dispatch('auth/login', this.loginForm);

      if (this.apiStatus) {
        this.$router.push('/');
      }
    },
    async register() {
      await this.$store.dispatch('auth/register', this.registerForm);

      if (this.apiStatus) {
        this.$router.push('/');
      }
    },
    clearError() {
      this.$store.commit('auth/setLoginErrorMessages', null);
      this.$store.commit('auth/setRegisterErrorMessages', null);
    }
  },
  created() {
    this.clearError();
  }
};
</script>
