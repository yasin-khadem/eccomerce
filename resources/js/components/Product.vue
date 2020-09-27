<template>
  <div class="card">
    <router-link :to="{name: 'product-show',params:{url:'show',slug:product.slug}}"> <img
      :src="'/' + product.image_src"
      class="card-img-top w-100"
      width="100"
    /> </router-link>
    <div class="card-body">
      <h5 class="card-title">{{ product.name }}</h5>
      <h5 class="card-category mb-3">
        <small>
          کد:
          {{ product.code }}
        </small>
      </h5>
      <h6 class="card-title">
        <strong> {{ formatToman(product.price) }} </strong>
      </h6>
      <h6 class="card-category">
        <small>دسته بندی</small>
      </h6>
    </div>
    <div class="card-footer">
        <strong :class="[product.exist ? 'text-success' : 'text-danger']">{{
          product.is_exist
        }}</strong>
      
    </div>
  </div>
</template>

<script>
import { formatTooman } from "prial";
export default {
  name: "Product",
  data() {
    return {
      formatToman: require("prial").formatToman,
    };
  },
  props: ["product"],
};
</script>

<style scoped>
 .card:hover {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  transition: 500ms;
}
</style>