<template>
   <div class="container ">
  <div class="d-flex flex-column align-items-center mx-auto">
    <div class="col-md-6">
      <header class="my-3">
        <div class="d-flex justify-content-between">
          <h5>پروفایل من</h5>
          <router-link
            class="btn btn-outline-dark"
            :to="{name: 'home'}"
          >
            <i class="fa fa-arrow-left"></i>
            بازگشت
          </router-link>
        </div>
      </header>
    </div>
    <div class="col-md-6">
      <form @submit.prevent="storeUser">
        <base-input name="name" label="نام" v-model="form.name"></base-input>
        <base-input name="email" label="ایمیل" type="email" v-model="form.email"></base-input>
        <base-input name="password" label="رمز عبور" type="password" v-model="form.password"></base-input>
        <input class="my-3" type="file">
        <br>
        <base-btn :loading="form.busy">ذخیره</base-btn>
      </form>
    </div>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";

export default {
name: "ProfileShow",
  data() {
    return {
      form: new Form({}),
    };
  },
}
</script>

<style scoped>

</style>