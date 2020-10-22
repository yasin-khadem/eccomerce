<template>
  <div class="container">
    <div class="d-flex flex-column align-items-center mx-auto">
      <div class="col-md-6">
        <header class="my-3">
          <div class="d-flex justify-content-between">
            <h5>ایجاد عکس جدید</h5>
            <router-link
              class="btn btn-outline-dark"
              :to="{name: 'admin-gallery', params:{url:'index'}}"
            >
              <i class="fa fa-arrow-left"></i>
              بازگشت
            </router-link>
          </div>
        </header>
      </div>
      <div class="col-md-6">
        <form @submit.prevent="storeImage">
          <base-input name="product_code" label="کد محصول" v-model="form.product_code"></base-input>
          <label for="image">عکس محصول</label>
          <input id="image" type="file"  @change="changeImage" />
          <br>
          <base-btn class="mt-3" :loading="form.busy">ذخیره</base-btn>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
import objectToFormData  from 'object-to-formdata'
export default {
  name: "AdminGalleryCreate",
  metaInfo:{
      title: 'ایجاد عکس گالری'
  },
  data() {
    return {
      form: new Form({
        product_code: null,
        image: null
      }),
    };
  },
  methods: {
    changeImage(event){
      this.form.image = event.target.files[0];
    
    },
    storeImage() {
        return this.form.submit('post', '/api/admin/image', {
            transformRequest: [function (data, header) {
                return objectToFormData(data);
            }]
        }).then(({data})=>{
          swal.message('عکس برای گالری ایجاد شد','success');
          this.$router.push({name:"admin-gallery",params:{url:"index"}});
        })
      // this.$store.dispatch('category/storeCategory', this.form)
      // .then(data => {
      //   this.$router.push({ name: "admin-category", params: { url: "index" } });
      //   swal.message();
      // });
    },
  },
};
</script>

<style>
</style>