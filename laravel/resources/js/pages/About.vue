<template>
  <div class="about">
    <section class="about__section">
      <h2>このサイトについて</h2>
      <p>このサイトは Laravel + Vue.js を使用した「履歴書・職務経歴書 管理アプリケーション」のベータ版です。</p>
      <p>
        ただし 2019/11/7 現在は，管理者
        <RouterLink to="/users/1">yatsubashi</RouterLink>&nbsp;を紹介するアプリケーションとしてのみ機能しています。
      </p>
    </section>
    <section class="about__section">
      <h2>主な使用技術</h2>
      <div class="grid">
        <Technology
          class="grid__item"
          v-for="technology in technologies"
          :key="technology.id"
          :item="technology"
        />
      </div>
    </section>
    <section class="about__section">
      <h2>アーキテクチャ</h2>
      <p>インフラストラクチャーには全面的に AWS を使用しています。</p>
      <figure class="panel">
        <img :src="architecture.url" alt="${architecture.name}" />
      </figure>
    </section>
  </div>
</template>

<script>
import Technology from '../components/Technology.vue';

export default {
  components: {
    Technology
  },
  data() {
    return {
      technologies: [
        {
          id: 1,
          name: 'Vue.js',
          description:
            'フロントエンドは JavaScript フレームワーク Vue.js を使用し，SPA (Single Page Application) として動作します。',
          url:
            'https://resume-catalog.s3-ap-northeast-1.amazonaws.com/production/images/about/vue_logo.png'
        },
        {
          id: 2,
          name: 'Laravel',
          description:
            'サーバーサイドは PHP フレームワーク Laravel を使用して REST-like API を構築しています。',
          url:
            'https://resume-catalog.s3-ap-northeast-1.amazonaws.com/production/images/about/laravel-logo.png'
        },
        {
          id: 3,
          name: 'Docker',
          description:
            'アプリケーション基盤として Docker を採用。開発・本番のどちらも Docker で稼働しています。',
          url:
            'https://resume-catalog.s3-ap-northeast-1.amazonaws.com/production/images/about/docker-logo.png'
        }
      ],
      architecture: {
        name: 'architecture',
        url:
          'https://resume-catalog.s3-ap-northeast-1.amazonaws.com/production/images/about/ResumeCatalog_architecture.jpg'
      }
    };
  }
};
</script>
