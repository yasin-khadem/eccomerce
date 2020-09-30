<template>
  <component :is="componentName"></component>
</template>

<script>
import NotFound from '@/views/errors/NotFound'
import Index from './AdminOrderIndex'
import Edit from './AdminOrderEdit'
export default {
  name: "AdminOrder",
  components: {
      NotFound,
      Index,
      Edit
  },
  props: ["url"],
  computed:{
    componentName(){
        return ["index","edit"].includes(this.url) ? this.url : 'not-found'
    }
  }
};
</script>

<style>
</style>