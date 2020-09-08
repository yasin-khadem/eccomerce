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
          <ul class="navbar-nav mr-auto">
            <!--     <li class="nav-item active">
                            <router-link class="nav-link" :to="{ name: 'home' }">صفحه اصلی</router-link>
            </li>-->
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
</style>
