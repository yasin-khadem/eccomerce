<template>
  <form
    class="d-flex flex-column align-items-center mt-5 login-width mx-auto py-2 container"
    @submit.prevent="register"
  >
    <h3>فرم ثبت نام</h3>
    <base-input
      name="name"
      type="name"
      label="نام"
      v-model="form.name"
    ></base-input>
    <base-input name="email" label="ایمیل" v-model="form.email"></base-input>
    <base-input
      name="password"
      type="password"
      label="رمز عبور"
      v-model="form.password"
    ></base-input>
    <base-input
      name="password_confirmation"
      type="password"
      label="تایید رمز عبور"
      v-model="form.password_confirmation"
    ></base-input>
    <base-btn :loading="form.busy" class="btn-block" btn="success mr-top"
      >ثبت نام</base-btn
    >
  </form>
</template>

<script>
import { Form } from "vform";

export default {
  name: "Register",
  metaInfo: {
    title: "فرم ثبت نام",
  },

  data() {
    return {
      form: new Form({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      }),
    };
  },

  methods: {
    register() {
      this.$store.dispatch("auth/register", this.form).then(() => {
        swal.message("ثبت نام انجام شد");
        let nextUrl = localStorage.getItem("nextUrl");
        if (nextUrl) {
          window.location.href = nextUrl;
        } else {
          this.$router.push({ name: "home" });
        }
      });
    },
  },
};
</script>

<style>
.login-width {
  max-width: 360px;
}
.mr-top {
  margin-top: 1rem;
}
</style>