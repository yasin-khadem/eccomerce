<template>
  <div
    class="mt-3 row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 d-flex justify-content-center"
  >
    <div
      class="col mb-4"
      v-for="(product, index) in product.related_products"
      :key="product.id"
    >
      <Product :product="product" />
    </div>
  </div>
</template>

<script>
import Product from "@/components/Product.vue";

export default {
  name: "RelatedProducts",
  components:{
      Product
  },
  props: {
    product: {
      type: [Object, Array],
      required: true,
    },
  },
  data() {
    return {
    };
  },
  computed: {},
  methods: {},
};
</script>

<style scoped>
.card {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  transition: 500ms;
}
</style>