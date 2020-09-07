<template>
  <component :is="componentName"></component>
</template>

<script>
import Login from '@/views/Auth/login'
import Register from '@/views/Auth/Register'
import Home from '@/views/Home'
import NotFound from '@/views/errors/NotFound'
export default {
name:"AuthRoutes",
props:['url'],
components:{
    Login,Register,Home,NotFound
},
computed: {
    componentName() {
        return ['login','register'].includes(this.url) ? this.url : 'not-found';
    }
},
}
</script>

<style>

</style>