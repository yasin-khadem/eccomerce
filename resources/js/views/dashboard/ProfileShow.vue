<template>
  <div class="container">
    <div class="d-flex flex-column align-items-center mx-auto">
      <div class="col-md-6">
        <header class="my-3">
          <div class="d-flex justify-content-between">
            <h5>پروفایل من</h5>
            <router-link class="btn btn-outline-dark" :to="{ name: 'home' }">
              <i class="fa fa-arrow-left"></i>
              بازگشت
            </router-link>
          </div>
        </header>
      </div>
      <div class="col-md-6">
        <form @submit.prevent="changeProfile">
          <base-input name="name" label="نام" v-model="form.name"></base-input>
          <base-input
            name="email"
            label="ایمیل"
            type="email"
            v-model="form.email"
          ></base-input>
          <base-input
            name="password"
            label="رمز عبور"
            type="password"
            v-model="form.password"
          ></base-input>
          <base-photo-input
            v-model="form.profile"
            name="profile"
            @src="changeProfileSrc"
          ></base-photo-input>
          <br />
          <base-btn :loading="form.busy">ثبت تغییرات</base-btn>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
import { mapGetters } from "vuex";

export default {
  name: "ProfileShow",
  data() {
    return {
      form: new Form({
        profile: null,
      }),
    };
  },
  computed: {
    ...mapGetters("auth", ["user"]),
  },
  created() {
    this.form = new Form({
      id: this.user.id,
      name: this.user.name,
      email: this.user.email,
      password: null,
      profile: this.user.profile_src,
      profile_name: null,
    });
  },
  methods: {
    changeProfile() {
      this.$store.dispatch('auth/profile',this.form);
    },
    changeProfileSrc(event) {
      this.form.profile_name = event;
    },
  },
};
</script>

<style scoped>
</style>