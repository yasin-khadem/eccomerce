<template>
  <form
    class="d-flex flex-column align-items-center mt-4 py-5 login-width mx-auto container"
    @submit.prevent="sendForgetPassword">
    <h4>ایمیل خود را وارد کنید</h4>
    <base-input name="email" class="bg-input mt-2" label="ایمیل" v-model="form.email" ></base-input>
    <base-btn :loading="form.busy" class="btn-block mt-3 "> ارسال لینک به کاربر</base-btn>
  </form>
</template>

<script>
import { Form } from "vform";
export default {
name: "ForgetPassword",
metaInfo: {
    title: "فراموش کردن رمز",
  },
  data() {
    return {
       form: new Form({
        email: null,
      }),
    }
  },
  methods: {
    sendForgetPassword() {
      this.form.post(`/api/forget-password`).then(({data})=>{
        swal.message('ایمیل ارسال شد',"info",2500,'ایمیل خود را چک کنید');
      })
    }
  },

}
</script>

<style scoped>
.bg-input{
  color: black;
}
</style>