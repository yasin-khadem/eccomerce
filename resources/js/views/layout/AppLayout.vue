<template>
<div class="color-back">
  <navbar></navbar>
  <router-view  :key="$route.fullPath"></router-view>
</div>
</template>

<script>
import Navbar from '@/components/Navbar'
export default {
    name:"AppLayout",
    components:{
        Navbar
    },
    data() {
      return {
        currentUrl: window.history.href
      }
    },
   
  watch: {
    currentUrl: function() {
      console.log(this.currentUrl);
    }
  }
}
</script>

<style scoped>
.color-back{
  background-color: #eee ;
}
</style>