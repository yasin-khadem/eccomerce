<template>
  <component :is="componentName"></component>
</template>

<script>
import Show from './Show'
import NotFound from '@/views/errors/NotFound'


export default {
name:"ProductRoutes",
components:{
    Show,
    NotFound,
   
},
props:['url'],
computed: {
    componentName() {
        return ['show'].includes(this.url) ? this.url : 'not-found';
    }
},
}
</script>

<style>

</style>