<template>
  <header class="header">
    <nav class="header__navbar">
      <RouterLink class="header__brand" to="/">Resumes</RouterLink>
      <div class="header__menu">
        <span v-if="isLoggedIn" class="header__item">ユーザ名</span>
        <div v-else class="header__item">
          <RouterLink class="button button--link" to="/login">ログイン / 新規登録</RouterLink>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  computed: {
    isLoggedIn() {
      return this.$store.getters['auth/isLoggedIn'];
    },
    username() {
      return this.$store.getters['auth/username'];
    }
  }
};
</script>
