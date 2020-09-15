<template>
  <div class="container">
    <div class="d-flex flex-column align-items-center mx-auto">
      <div class="col-md-6">
        <header class="my-3">
          <div class="d-flex justify-content-between">
            <h5>ایجاد دسته بندی جدید</h5>
            <router-link
              class="btn btn-outline-dark"
              :to="{name: 'admin-category', params:{url:'index'}}"
            >
              <i class="fa fa-arrow-left"></i>
              بازگشت
            </router-link>
          </div>
        </header>
      </div>
      <div class="col-md-6">
        <form @submit.prevent="storeCategory">
          <base-input name="name" label="نام دسته بندی" v-model="form.name"></base-input>
          <base-btn class="mt-3" :loading="form.busy">ذخیره</base-btn>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
export default {
  name: "AdminCategoryCreate",
  metaInfo:{
      title: 'ایجاد دسته بندی جدید'
  },
  data() {
    return {
      form: new Form({
        name: null,
      }),
    };
  },
  methods: {
    storeCategory() {
      this.$store.dispatch('category/storeCategory', this.form)
      .then(data => {
        this.$router.push({ name: "admin-category", params: { url: "index" } });
        swal.message();
      });
    },
  },
};
</script>

<style>
</style>