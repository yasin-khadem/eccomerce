<template>
  <form
    class="d-flex flex-column align-items-center mt-5 py-5 login-width mx-auto container"
    @submit.prevent="login">
    <h2>فرم ورود</h2>
    <base-input name="email" type="email" label="ایمیل" v-model="form.email"></base-input>
    <base-input name="password" type="password" label="رمز عبور" v-model="form.password"></base-input>
      <base-check name="remember"
                    field="remember"
                    label="مرا به خاطر بسپار"
                    v-model="form.remember"></base-check>
    
    <a href="#" class="my-2">ایا رمز عبور خود را فراموش کرده اید؟</a>

    <base-btn :loading="form.busy" class="btn-block mt-3">ورود</base-btn>
  </form>
</template>

<script>
import { Form } from "vform";
export default {
  name: "Login",
  metaInfo: {
    title: "فرم ورود",
  },
  data() {
    return {
      form: new Form({
        email: null,
        password: null,
        remember: false,
      }),
    };
  },
  methods: {
    login() {
      this.$store.dispatch('auth/login',this.form).then(()=>{
        this.$router.push({name: 'home'});
      })
    },
  },
};
</script>

<style scoped>
.login-width {
  max-width: 360px;
}




</style>