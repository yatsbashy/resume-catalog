<template>
  <footer class="footer">
    <button v-if="isLoggedIn" class="button button--link" @click="logout">ログアウト</button>
    <RouterLink v-else class="button button--link" to="/login">ログイン / 新規登録</RouterLink>
  </footer>
</template>

<script>
import { mapState, mapGetters } from 'vuex';

export default {
  computed: {
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
