<template>
    <component :is="componentName"></component>
</template>

<script>

import NotFound from '@/views/errors/NotFound'
import Show from '@/views/dashboard/ProfileShow'
import Edit from '@/views/dashboard/ProfileEdit'

export default {
name:"profile",
props:['url'],
components:{
    NotFound,
    Edit,
    Show

},
// data() {
//     return {
//         key: value
//     }
// },
computed:{
   componentName(){
       return ['show','edit'].includes(this.url) ? this.url : 'not-found'
   } 
}
}
</script>

<style>

</style>