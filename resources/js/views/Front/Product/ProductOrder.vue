<template>
  <div class="container">
    <order-form :formProduct="formProduct" :product="product"> </order-form>
  </div>
</template>

<script>
import OrderForm from "@/views/Front/Product/OrderForm.vue";
export default {
  name: "ProductOrder",
  components: {
    OrderForm,
  },
  data() {
    return {
      slug: this.$route.params.slug,
      product: {},
      formProduct: {},
    };
  },
  created() {
    axios
      .get(`/api/product/${this.slug}`)
      .then(({ data }) => {
        this.product = data;
        this.formProduct = data;
      })
      .catch(({ response }) => {
        if (response.status === 404) this.$router.push({ name: "not-found" });
      });
  },
};
</script>

<style>
</style>