<template>
  <div class="w-100" id="bg-navbar">
    <div class="container">
      <nav class="row navbar navbar-expand-lg navbar-dark bg-dark" dir="ltr">
        <router-link class="navbar-brand" :to="{ name: 'home' }">وب آموز</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="mt-2 navbar-nav mr-auto">
           <template v-if="isLoggedIn">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'dashboard-index' }">
             <template class="mr-2"> داشبورد </template>
                        <i class="fa fa-tachometer-alt mx-2"></i>
              </router-link>
            </li>
               <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'admin-user' , params: {url: 'index'}}">
             <template class="mr-2"> کاربران </template>
                        <i class="fa fa-users mx-2"></i>
              </router-link>
            </li>
            
             <li class="nav-item">
              <a class="nav-link" @click.prevent="logout">
             <template class="mr-2"> خروج </template>
                        <i class="fa fa-sign-out-alt mx-2"></i>
              </a>
            </li>
            
            
           </template>
          </ul>
          <div class="form-inline my-2 my-lg-0" dir="rtl">
            <template v-if="! isLoggedIn">
              <router-link :to="{ name: 'auth', params: { url: 'register' } }">
                <base-btn class="my-2 my-sm-0 mr-2" btn="success">ثبت نام</base-btn>
              </router-link>
              <router-link :to="{ name: 'auth', params: { url: 'login'} }">
                <base-btn class="my-2 my-sm-0 mr-2">ورود</base-btn>
              </router-link>
            </template>
            <template v-else>
              <div class="dropdown background-dropdown-color">
                <button
                  class="btn dropdown-toggle text-white"
                  @click="dropDownShow = dropDownShow ?  null : 'show'"
                >{{ user.name }}</button>
                <div class="dropdown-menu background-dropdown-menu-color" :class="dropDownShow">
                  <a class="dropdown-item" href="#">پروفایل</a>
                  <a class="dropdown-item" href="#" @click="logout">خروج</a>
                </div>
              </div>
            </template>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Navbar",
  data() {
    return {
      dropDownShow: null,
    };
  },
  computed: {
    ...mapGetters("auth", ["user", "isLoggedIn"]),
  },
  watch:{
      '$route'(){
          $('#navbarSupportedContent').collapse('hide');
      }
    },
  methods: {
    logout() {
      this.$store.dispatch("auth/logout").then(() => {
        this.$router.push({ name: "home" });
      });
    },
  },
};
</script>

<style scoped>
#bg-navbar {
  background-color: #343a40;
}
.background-dropdown-color {
  background-color: #9c27b0;
}
.background-dropdown-menu-color {
  background-color: rgba(0, 0, 0, 0.185);
}
ul>li{

}
ul>li:hover{
  background: #9b27b0;
  transition: 500ms;

}
.nav-item .active{
  background: #9b27b0c5;
}
</style>
