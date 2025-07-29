<template>
  <div class="w-full">
    <img
      src="https://www.velooise.fr/wp-content/uploads/2025/07/20212007.CCAC_SDC_COPIL_20211007.jpg"
      class="object-contain w-full h-screen"
      :alt="`plan officiel des ${getRevName()}`"
    >
  </div>
</template>

<script setup lang="ts">
const { getRevName } = useConfig();

const description = `Découvrez le plan officiel du schéma Cyclable de l'Aire Cantilienne`;
const COVER_IMAGE_URL = 'https://cyclopolis.lavilleavelo.org/cyclopolis.png';

useHead({
  title: `Schéma cyclable de l'Aire Cantilienne`,
  meta: [
    // description
    { hid: 'description', name: 'description', content: description },
    { hid: 'og:description', property: 'og:description', content: description },
    // cover image
    { hid: 'og:image', property: 'og:image', content: COVER_IMAGE_URL },
    { hid: 'twitter:image', name: 'twitter:image', content: COVER_IMAGE_URL }
  ]
});
</script>
