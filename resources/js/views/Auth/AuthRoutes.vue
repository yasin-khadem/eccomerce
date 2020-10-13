<template>
  <component :is="componentName"></component>
</template>

<script>
import Login from '@/views/Auth/login'
import Register from '@/views/Auth/Register'
import ForgetPassword from '@/views/Auth/ForgetPassword'
import ResetPassword from '@/views/Auth/ResetPassword'
import Home from '@/views/Home'
import NotFound from '@/views/errors/NotFound'
export default {
name:"AuthRoutes",
props:['url'],
components:{
    Login,Register,Home,NotFound,ForgetPassword,ResetPassword
},
computed: {
    componentName() {
        return ['login','register','forget-password','reset-password'].includes(this.url) ? this.url : 'not-found';
    }
},
}
</script>

<style>

</style>