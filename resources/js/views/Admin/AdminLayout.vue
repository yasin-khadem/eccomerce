<template>
  <div>
    <navbar></navbar>
    <router-view :key="$route.fullPath"></router-view>
  </div>
</template>

<script>
import Navbar from "@/components/Navbar";
export default {
  name: "AdminLayout",
  components: {
    Navbar,
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

};
</script>

<style>
</style>