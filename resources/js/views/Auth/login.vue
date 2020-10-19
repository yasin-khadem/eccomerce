<template>
  <form
    class="d-flex flex-column align-items-center mt-4 py-5 login-width mx-auto container"
    @submit.prevent="login">
    <h2>فرم ورود</h2>
    <base-input name="email" label="ایمیل" v-model="form.email"></base-input>
    <base-input name="password" type="password" label="رمز عبور" v-model="form.password"></base-input>
      <base-check name="remember"
                    field="remember"
                    label="مرا به خاطر بسپار"
                    v-model="form.remember"></base-check>
    <router-link :to="{name:'auth',params:{url:'register'}}" class="register-link my-2"> 
        <strong>
        ثبت نام نکرده اید؟ اینجا کلیک کنید
        </strong>
        </router-link>

    <base-btn :loading="form.busy" class="btn-block mt-3">ورود</base-btn>
            <router-link :to="{name:'auth',params:{url:'forget-password'}}" class="forget-password-link my-2">ایا رمز عبور خود را فراموش کرده اید؟</router-link>


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
.register-link{
  color:  #0276fd;
}
.forget-password-link{
  color: #0062d1;
}




</style>