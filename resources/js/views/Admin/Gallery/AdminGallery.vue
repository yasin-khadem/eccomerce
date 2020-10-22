<template>
  <component :is="componentName"></component>
</template>

<script>
import Index from "./AdminGalleryIndex";
import NotFound from "@/views/errors/NotFound";
import Create from "./AdminGalleryCreate";

export default {
  name: "AdminGallery",
  components: {
    Index,
    NotFound,
    Create,
  },
  props: ["url"],
  computed: {
    componentName() {
      return ["index", "create"].includes(this.url) ? this.url : "not-found";
    },
  },
};
</script>

<style>
</style>