<template>
  <component :is="componentName"></component>
</template>

<script>
import Index from './AdminUserIndex'
import NotFound from '@/views/errors/NotFound'
import Create from './AdminUserCreate'

export default {
name:"AdminUser",
components:{
    Index,
    NotFound,
    Create
},
props:['url'],
computed: {
    componentName() {
        return ['index','create'].includes(this.url) ? this.url : 'not-found';
    }
},
}
</script>

<style>

</style>