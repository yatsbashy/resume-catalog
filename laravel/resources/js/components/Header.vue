<template>
  <header class="header">
    <nav class="header__navbar">
      <RouterLink class="header__brand" to="/">Resumes</RouterLink>
      <div class="header__menu">
        <span class="header__item">ユーザ名</span>
        <div class="header__item">
          <RouterLink class="button button--link" to="/login">ログイン / 新規登録</RouterLink>
        </div>
      </div>
    </nav>
  </header>
</template>
