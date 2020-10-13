<template>
  <div>
    <form
      class="d-flex flex-column align-items-center mt-5 login-width mx-auto py-2 container"
      @submit.prevent="resetPassword"
    >
      <h3>فرم بازیابی رمز</h3>
      <base-input
        name="email"
        type="email"
        label="ایمیل"
        v-model="form.email"
      ></base-input>
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
        >بازیابی رمز</base-btn
      >
    <router-link class="mt-3 back-login" :to="{name:'auth',params:{url:'login'}}">بازگشت به صفحه ورود</router-link>
    </form>
  </div>
</template>

<script>
import { Form } from "vform";
export default {
  name: "ResetPassword",
  metaInfo: {
    title: "بازیابی رمز عبور",
  },
  data() {
    return {
      form: new Form({
        email: null,
        token: null,
        password: null,
        password_confirmation: null,
      }),
    };
  },
  created() {
    this.form.token = this.$route.query.token;
  },
  methods: {
    resetPassword() {
      this.form
        .post(`/api/reset-password`)
        .then(({ data }) => {
          //  window.location.href =
          //   document.location.origin + "/auth/login";
          swal.message(
            "با موفقیت انجام شد",
            "success",
            2500,
            "رمز شما تغییر کرد به صفحه بروید"
          );
        })
        .catch((e) => {
          swal.message(
            "دوباره تلاش کنید",
            "warning",
            2500,
            "تلاش قبلی شما ناموفق بود"
          );
          // window.location.href =
          //   document.location.origin + "/auth/forget-password";
        });
    },
  },
};
</script>

<style scoped>
.back-login{
  color: blue;
}
</style>