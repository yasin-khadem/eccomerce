<template>
  <component :is="componentName"></component>
</template>

<script>
import NotFound from '@/views/errors/NotFound'
import Index from './AdminOrderIndex'
export default {
  name: "AdminOrder",
  components: {
      NotFound,
      Index,
  },
  props: ["url"],
  computed:{
    componentName(){
        return ["index"].includes(this.url) ? this.url : 'not-found'
    }
  }
};
</script>

<style>
</style>