<template>
  <component :is="componentName"></component>
</template>

<script>
import Index from './AdminCategoryIndex'
import NotFound from '@/views/errors/NotFound'
import Create from './AdminCategoryCreate'
import Edit from './AdminCategoryEdit'

export default {
name:"AdminCategory",
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