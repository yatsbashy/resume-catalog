<template>
  <div class="technology panel">
    <figure class="technology__figure picture__wrapper--square">
      <img :src="item.url" alt="${item.name}" />
    </figure>
    <h3 class="technology__title">{{ item.name }}</h3>
    <p class="technology__description">{{ item.description }}</p>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
};
</script>
