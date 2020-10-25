<template>
  <div class="container">
    <div class="d-flex flex-column align-items-center mx-auto">
      <div class="col-md-6">
        <header class="my-3">
          <div class="d-flex justify-content-between">
            <h5>ویرایش محصول</h5>
            <router-link
              class="btn btn-outline-dark"
              :to="{ name: 'admin-product', params: { url: 'index' } }"
            >
              <i class="fa fa-arrow-left"></i>
              بازگشت
            </router-link>
          </div>
        </header>
      </div>
      <div class="col-md-6">
        <form @submit.prevent="updateProduct">
          <base-input name="name" label="نام" v-model="form.name"></base-input>
          <base-input
            name="code"
            label="کد محصول"
            v-model="form.code"
          ></base-input>
          <base-input
            name="description"
            label="توضیحات"
            v-model="form.description"
          ></base-input>
          <button class="btn btn-primary my-2" @click.prevent="changeExisting">
            تغییر موجودیت
          </button>
          <base-input
            name="price"
            label="قیمت"
            v-model="form.price"
          ></base-input>
          <tags-input
            class="myform-control"
            element-id="tags"
            :wrapper-class="
              form.errors.has('selectedTags.0')
                ? 'tags-input-wrapper-default tags-input is-invalid form-control'
                : 'tags-input-wrapper-default tags-input'
            "
            v-model="form.selectedTags"
            :existing-tags="categories"
            :typeahead="true"
            placeholder="دسته بندی های محصول"
            :only-existing-tags="true"
          ></tags-input>
          <has-error :form="form" field="selectedTags.0"></has-error>
          <div class="form-group mt-3">
            <label for="image">عکس محصول</label>
            <input id="image" type="file" @change="changeImage" />
            <has-error :form="form" field="image"></has-error>
          </div>
          <base-btn class="mt-3" :loading="form.busy">ذخیره</base-btn>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Form, HasError } from "vform";
import { mapState } from "vuex";
import TagsInput from "@voerro/vue-tagsinput";

export default {
  name: "AdminProductEdit",
  data() {
    return {
      form: new Form({}),
      //  form._meth
      categories: [],
    };
  },
  components: {
    TagsInput,
    HasError,
  },

  created() {
    axios.get("/api/admin/categories-search").then(({ data }) => {
      this.categories = data.data;
    });
    this.$store
      .dispatch("product/getProduct", this.$route.params.slug)
      .then((data) => {
        this.form = new Form({
          name: data.name,
          slug: data.slug,
          code: data.code,
          image: null,
          description: data.description,
          price: data.price,
          exist: data.exist,
          selectedTags: data.selectedTags,
          _method: "patch",
        });
      });
  },
  metaInfo: {
    title: "ویرایش محصول",
  },
  methods: {
    changeExisting() {
      swal.confirm("آیا مطمئن هستید؟", "warning", " ").then((result) => {
        if (result.value) {
          // return 0;
          return axios
            .patch(`/api/admin/product-update/${this.form.slug}`, {
              exist: this.form.exist,
            })
            .then(({ data }) => {
              this.$router.push({
                name: "admin-product",
                params: { url: "index" },
              });
              swal.message("محصول شما ویرایش شد");
            });
        }
      });
    },
    updateProduct() {
      this.$store.dispatch("product/updateProduct", this.form).then(() => {
        this.$router.push({ name: "admin-product", params: { url: "index" } });
        swal.message("محصول شما ویرایش شد");
      });
    },
    changeImage(event) {
      this.form.image = event.target.files[0];
    },
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

