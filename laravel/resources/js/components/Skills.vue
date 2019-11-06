<template>
  <div class="skill">
    <table class="table">
      <tr class="table__tr">
        <th class="table__th">種別</th>
        <th class="table__th">経験期間</th>
        <th class="table__th">備考</th>
      </tr>
      <tr class="table__tr" v-for="skill in skills" :key="skill.id">
        <td class="table__td">{{ skill.name }}</td>
        <td class="table__td">{{ skill.months_experience }} ヶ月</td>
        <td class="table__td">{{ skill.comment }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import { OK } from '../util';

export default {
  data() {
    return {
      skills: []
    };
  },
  created: function() {
    this.fetchSkills();
  },
  watch: {
    $route: 'fetchSkills'
  },
  methods: {
    async fetchSkills() {
      const response = await axios.get(
        `/api/users/${this.$route.params.id}/skills`
      );

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status);
        return false;
      }

      this.skills = response.data.data;
    }
  }
};
</script>
