<template>
  <div class="container mt-5">
    <main-product-show :product="product" @setOrderForm="setOrderForm"></main-product-show>

    <!--   فرم ثبت سفارش آدرش ، شماره تلفن ، کد پستی    -->
    <order-form
      v-if="orderForm"
      :orderForm="orderForm"
      :formProduct="formProduct"
      :product="product"
    >
    </order-form>
    <!--   فرم ثبت سفارش آدرش ، شماره تلفن ، کد پستی    -->
    <div class="d-flex justify-content-center mt-5">
      <h3 v-if="showTitle">محصولات مربوطه</h3>
    </div>
    <hr />
    <related-products
      v-if="product.related_products"
      :product="product"
    ></related-products>
  </div>
</template>
<script>
import { formatTooman } from "prial";
import { Form } from "vform";
import { mapState } from "vuex";
import Product from "@/components/Product.vue";
import RelatedProducts from "@/views/Front/Product/RelatedProducts.vue";
import OrderForm from "@/views/Front/Product/OrderForm.vue";
import MainProductShow from "@/views/Front/Product/MainProductShow.vue";
export default {
  name: "Show",
  metaInfo() {
    return {
      title: "محصول " + this.slug,
    };
  },
  components: {
    Product,
    RelatedProducts,
    OrderForm,
    MainProductShow,
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
      product: {},
      slug: this.$route.params.slug,
      orderForm: false,
      formProduct: {},
    };
  },
  computed: {
    showTitle() {
      return _.isEmpty(this.product.related_products) ? false : true;
    },
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
  methods: {
    setOrderForm(event){
      this.orderForm = event
    }
  },
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