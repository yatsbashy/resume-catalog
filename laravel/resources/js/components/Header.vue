<template>
  <header class="header">
    <nav class="header__navbar">
      <RouterLink class="header__brand" to="/">ResumeCatalog</RouterLink>
      <div class="header__menu">
        <span v-if="isLoggedIn" class="header__item header__item--username">{{ username }} さん</span>
        <div class="header__item">
          <RouterLink class="button button--link" to="/about">このサイトについて</RouterLink>
        </div>
        <div v-if="isLoggedIn" class="header__item">
          <button class="button button--link" @click="logout">ログアウト</button>
        </div>
        <div v-else class="header__item">
          <RouterLink class="button button--link" to="/login">ログイン / 新規登録</RouterLink>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import { mapState, mapGetters } from 'vuex';

export default {
  computed: {
    isLoggedIn() {
      return this.$store.getters['auth/isLoggedIn'];
    },
    username() {
      return this.$store.getters['auth/username'];
    },
    ...mapState({
      apiStatus: state => state.auth.apiStatus
    }),
    ...mapGetters({
      isLoggedIn: 'auth/isLoggedIn'
    })
  },
  methods: {
    async logout() {
      await this.$store.dispatch('auth/logout');

      if (this.apiStatus) {
        this.$router.push('/login');
      }
    }
  }
};
</script>
