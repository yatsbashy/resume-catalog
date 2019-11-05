<template>
  <div class="work">
    <table class="table">
      <tr class="table__tr">
        <th class="table__th">期間</th>
        <th class="table__th">業務内容</th>
        <th class="table__th">役割・規模</th>
      </tr>
      <template v-for="work in works">
        <tr class="table__tr" :key="work.id">
          <td class="table__td table__td">{{ work.started_at }} 開始</td>
          <td class="table__td" rowspan="2">{{ work.description }}</td>
          <td class="table__td" rowspan="2">{{ work.role }}</td>
        </tr>
        <tr class="table__tr" :key="work.id">
          <td class="table__td">{{ work.ended_at }} 終了</td>
        </tr>
      </template>
    </table>
  </div>
</template>

<script>
import { OK } from '../util';

export default {
  data() {
    return {
      works: []
    };
  },
  created: function() {
    this.fetchWorks();
  },
  watch: {
    $route: 'fetchWorks'
  },
  methods: {
    async fetchWorks() {
      const response = await axios.get(
        `/api/users/${this.$route.params.id}/works`
      );

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status);
        return false;
      }

      this.works = response.data.data;
    }
  }
};
</script>
