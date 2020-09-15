<template>
  <div class="container">
    <div class="d-flex flex-column align-items-center mx-auto">
      <div class="col-md-6">
        <header class="my-3">
          <div class="d-flex justify-content-between">
            <h5>ویرایش دسته بندی</h5>
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
        <form @submit.prevent="updateCategory">
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
  name: "AdminCategoryEdit",
  metaInfo: {
    title: "ویرایش دسته بندی ",
  },
  data() {
    return {
      form: new Form({}),
    };
  },
  created() {
    this.$store
      .dispatch("category/getCategory", this.$route.params.slug)
      .then(({ data }) => {
        this.form = new Form({
          name: data.name,
          slug: data.slug,
        });
      });
  },
  methods: {
    updateCategory() {
      this.$store.dispatch("category/updateCategory", this.form).then(({data})=>{
        this.$router.push({name:'admin-category',params:{url: 'index'}})
        swal.message();
      })
    },
  },
};
</script>

<style>
</style>