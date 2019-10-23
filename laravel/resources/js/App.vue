<template>
  <div>
    <Header />
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import { INTERNAL_SERVER_ERROR } from './util';

export default {
  components: {
    Header,
    Footer
  },
  computed: {
    errorCode() {
      return this.$store.state.error.code;
    }
  },
  watch: {
    errorCode: {
      async handler(val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500');
        }
      },
      immediate: true
    },
    $route() {
      this.$store.commit('error/setCode', null);
    }
  }
};
</script>
