<template>
  <div class="resume-detail container--medium">
    <div class="resume-detail__profile-header">
      <figure class="picture__wrapper--square">
        <img class="picture__image--circle" :src="user.profile_picture_url" alt />
      </figure>
      <h2 class="resume-detail__name">{{ user.name }}</h2>
    </div>
    <ul class="tab tab--center tab--top-margin">
      <RouterLink
        tag="li"
        class="tab__item tab__item--link"
        exact-active-class="tab__item--active"
        :to="profileUrl"
      >
        <a>Profile</a>
      </RouterLink>
      <RouterLink
        tag="li"
        class="tab__item tab__item--link"
        exact-active-class="tab__item--active"
        :to="skillsUrl"
      >
        <a>Skills</a>
      </RouterLink>
      <RouterLink
        tag="li"
        class="tab__item tab__item--link"
        exact-active-class="tab__item--active"
        :to="worksUrl"
      >
        <a>Works</a>
      </RouterLink>
    </ul>
    <div class="panel">
      <RouterView />
    </div>
  </div>
</template>

<script>
import { OK } from '../util';

export default {
  data() {
    return {
      user: null,
      profileUrl: `/users/${this.$route.params.id}/profile`,
      skillsUrl: `/users/${this.$route.params.id}/skills`,
      worksUrl: `/users/${this.$route.params.id}/works`
    };
  },
  created: function() {
    this.fetchUser();
  },
  methods: {
    async fetchUser() {
      const response = await axios.get(`/api/users/${this.$route.params.id}`);

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status);
        return false;
      }

      this.user = response.data.data;
    }
  }
};
</script>
