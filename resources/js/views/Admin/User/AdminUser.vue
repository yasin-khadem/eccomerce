<template>
  <component :is="componentName"></component>
</template>

<script>
import Index from './AdminUserIndex'
import NotFound from '@/views/errors/NotFound'
import Create from './AdminUserCreate'
import Edit from './AdminUserEdit'

export default {
name:"AdminUser",
components:{
    Index,
    NotFound,
    Create,
    Edit
},
props:['url'],
computed: {
    componentName() {
        return ['index','create','edit'].includes(this.url) ? this.url : 'not-found';
    }
},
}
</script>

<style>

</style>