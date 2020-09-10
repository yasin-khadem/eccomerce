<template>
  <component :is="componentName"></component>
</template>

<script>
import Index from './AdminUserIndex'
import NotFound from '@/views/errors/NotFound'

export default {
name:"AdminUser",
components:{
    Index,
    NotFound
},
props:['url'],
computed: {
    componentName() {
        return ['index'].includes(this.url) ? this.url : 'not-found';
    }
},
}
</script>

<style>

</style>