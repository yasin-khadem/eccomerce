<template>
  <component :is="componentName"></component>
</template>

<script>
import Login from '@/views/Auth/login'
import Register from '@/views/Auth/Register'
import Home from '@/views/Home'
export default {
name:"AuthRoutes",
props:['url'],
components:{
    Login,Register,Home
},
computed: {
    componentName() {
        return ['login','register'].includes(this.url) ? this.url : 'home';
    }
},
}
</script>

<style>

</style>