<template>
<div>
  <navbar></navbar>
  <router-view id="mainpagemargin" :key="$route.fullPath"></router-view>
</div>
</template>

<script>
import Navbar from '@/components/Navbar'
export default {
    name:"AppLayout",
    components:{
        Navbar
    }
}
</script>

<style scoped>
  #mainpagemargin{
        margin-top: 55px;
    }   
</style>