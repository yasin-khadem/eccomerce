<template>
  <component :is="componentName"></component>
</template>

<script>
import Index from './AdminProductIndex'
import NotFound from '@/views/errors/NotFound'
import Create from './AdminProductCreate'
import Edit from './AdminProductEdit'

export default {
name:"AdminProduct",
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