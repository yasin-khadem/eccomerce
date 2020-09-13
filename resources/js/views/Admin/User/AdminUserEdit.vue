<template>
  <div class="container">
    <div class="d-flex flex-column align-items-center mx-auto">
      <div class="col-md-6">
        <header class="my-3">
          <div class="d-flex justify-content-between">
            <h5>ویرایش کاربر</h5>
            <router-link
              class="btn btn-outline-dark"
              :to="{name: 'admin-user', params:{url:'index'}}"
            >
              <i class="fa fa-arrow-left"></i>
              بازگشت
            </router-link>
          </div>
        </header>
      </div>
      <div class="col-md-6">
        <form @submit.prevent="updateUser">
          <base-input name="name" label="نام" v-model="form.name"></base-input>
          <base-input name="email" label="ایمیل" type="email" v-model="form.email"></base-input>
          <base-input name="password" label="رمز عبور" type="password" v-model="form.password"></base-input>
          <div class="position-checkbox">
            <base-check name="is_admin" field="is_admin" label="ادمین" v-model="form.is_admin"></base-check>
          </div>
          <base-btn class="mt-3" :loading="form.busy">ذخیره</base-btn>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {Form} from 'vform'
export default {
   name: "AdminUserEdit",
  metaInfo:{
    title: "ویرایش کاربر"
  },
  data() {
    return {
      form: new Form({
        name: null,
        email: null,
        password: "password",
        is_admin: false,
      })
    }
  },
  computed:{
    url(){
      return `/api/admin/users/${this.$route.params.id}`;
    }
  },
  created(){
    axios.get(this.url).then(({data})=>{
      this.form = new Form({
        id: data.id,
        name: data.name,
        email: data.email,
        password: null,
        is_admin: !! data.is_admin,
      })
    })
  },
  methods: {
    updateUser(){
      this.form.patch(this.url,this.form).then(({data})=>{
        this.$router.push({name:"admin-user",params: {url: "index"}})
      })
    }
  },
};
</script>

<style>
</style>