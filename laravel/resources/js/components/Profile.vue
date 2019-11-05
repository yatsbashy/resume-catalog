<template>
  <div class="profile">
    <table class="table">
      <tr class="table__tr">
        <th class="table__th">専門</th>
        <td class="table__td">{{ profile.specialty }}</td>
      </tr>
      <tr class="table__tr">
        <th class="table__th">GitHub</th>
        <td class="table__td">
          <a
            :href="profile.github_url"
            target="_blank"
            rel="noopener noreferrer"
          >{{ profile.github_url }}</a>
        </td>
      </tr>
      <tr class="table__tr">
        <th class="table__th">Qiita</th>
        <td class="table__td">
          <a
            :href="profile.qiita_url"
            target="_blank"
            rel="noopener noreferrer"
          >{{ profile.qiita_url }}</a>
        </td>
      </tr>
      <tr class="table__tr--no-border">
        <th class="table__th">最終学歴</th>
        <td class="table__td">{{ profile.final_education }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import { OK } from '../util';

export default {
  data() {
    return {
      profile: null
    };
  },
  created: function() {
    this.fetchProfile();
  },
  watch: {
    $route: 'fetchProfile'
  },
  methods: {
    async fetchProfile() {
      const response = await axios.get(
        `/api/users/${this.$route.params.id}/profile`
      );

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status);
        return false;
      }

      this.profile = response.data.data;
    }
  }
};
</script>
