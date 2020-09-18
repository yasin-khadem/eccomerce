<template>
  <div class="container">
    <div class="d-flex flex-column align-items-center mx-auto">
      <div class="col-md-6">
        <header class="my-3">
          <div class="d-flex justify-content-between">
            <h5>ثبت محصول جدید</h5>
            <router-link
              class="btn btn-outline-dark"
              :to="{name: 'admin-product', params:{url:'index'}}"
            >
              <i class="fa fa-arrow-left"></i>
              بازگشت
            </router-link>
          </div>
        </header>
      </div>
      <div class="col-md-6">
        <form @submit.prevent="storeProduct">
          <base-input name="name" label="نام" v-model="form.name"></base-input>
          <base-input name="code" label="کد محصول" v-model="form.code"></base-input>
          <base-input name="description" label="توضیحات" v-model="form.description"></base-input>
          <base-input name="price" label="قیمت" v-model="form.price"></base-input>
          <tags-input
            element-id="tags"
            v-model="form.selectedTags"
            :existing-tags="categories"
            :typeahead="true"
            :only-existing-tags="true"
          ></tags-input>
          <base-btn class="mt-3" :loading="form.busy">ذخیره</base-btn>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import TagsInput from "@voerro/vue-tagsinput";
import { Form , HasError } from "vform";

export default {
  name: "AdminProductCreate",
  metaInfo: {
    title: "ثبت محصول جدید",
  },
  components: {
    TagsInput,HasError
  },
  data() {
    return {
      form: new Form({
        name: null,
        code: null,
        description: null,
        price: null,
        selectedTags: [],
      }),
      categories:[]
    };
  },
  created(){
    axios.get('/api/admin/categories-search').then(({data})=>{
      this.categories = data.data
    })
  },
  methods: {
    storeProduct() {
      this.$store.dispatch('product/store',this.form)
      .then(()=>{
        swal.message('محصول ثبت شد');
        this.$router.push({name: "admin-product", params:{url:"index"}});
      });
     
    },
  },
};
</script>

<style scoped>

</style>