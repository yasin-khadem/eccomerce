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
          <base-input name="description" label="توضیحات" v-model="form.description"></base-input>
          <base-input name="price" label="قیمت" v-model="form.price"></base-input>
          <tags-input
            element-id="tags"
            v-model="selectedTags"
            :existing-tags="[
        { key: 'web-development', value: 'Web Development' },
        { key: 'php', value: 'PHP' },
        { key: 'javascript', value: 'JavaScript' },
    ]"
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
import { Form } from "vform";

export default {
  name: "AdminProductCreate",
  metaInfo: {
    title: "ثبت محصول جدید",
  },
  components: {
    TagsInput,
  },
  data() {
    return {
      form: new Form({
        name: null,
        description: null,
        price: null,
        selectedTags: [],
      }),
    };
  },
  methods: {
    storeProduct() {},
  },
};
</script>

<style>
</style>