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
          <div class="form-groupe">
            <label for="description">توضیحات</label>
            <div class="form-group bmd-form-group">
              <textarea class="form-control" name="description" id="description" v-model="form.description"></textarea>
              <has-error :form="form" field="description"></has-error>
            </div>
          </div>
          <base-input name="price" label="قیمت" v-model="form.price"></base-input>
          <tags-input
            class="myform-control"
            element-id="tags"
            :wrapper-class="form.errors.has('selectedTags.0') ? 'tags-input-wrapper-default tags-input is-invalid form-control' : 'tags-input-wrapper-default tags-input'"
            v-model="form.selectedTags"
            :existing-tags="categories"
            :typeahead="true"
            placeholder="دسته بندی های محصول"
            :only-existing-tags="true"
          ></tags-input>
          <has-error :form="form" field="selectedTags.0"></has-error>

          <div class="form-group mt-3">


          <label for="image">عکس محصول</label>
          <input id="image" type="file"  @change="changeImage" />
          <has-error :form="form" field="image"></has-error>


          </div>

          <base-btn class="mt-3" :loading="form.busy">ذخیره</base-btn>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import TagsInput from "@voerro/vue-tagsinput";
import objectToFormData  from 'object-to-formdata'

import { Form, HasError } from 'vform';

export default {
  name: "AdminProductCreate",
  metaInfo: {
    title: "ثبت محصول جدید",
  },
  components: {
    TagsInput,
    HasError,
  },
  data() {
    return {
      form: new Form({
        name: null,
        code: null,
        image:null,
        description: null,
        price: null,
        selectedTags: [],
      }),
      categories: [],
    };
  },
  created() {
    axios.get("/api/admin/categories-search").then(({ data }) => {
      this.categories = data.data;
    });
  },
  methods: {
    storeProduct() {
      // this.form.submit('post','/api/admin/product',{
      //               transformRequest: [function (data, header) {
      //                   return objectToFormData(data);
      //               }]
      //           })
      this.$store.dispatch("product/store", this.form).then(() => {
        swal.message("محصول ثبت شد");
        this.$router.push({ name: "admin-product", params: { url: "index" } });
      });
    },
    changeImage(event){
      this.form.image = event.target.files[0];
    }
  },
};
</script>

<style scoped>
.myform-control {
  border: 1px solid #b7bfc9;
}
.invalid-feedback {
  display: block;
}
</style>