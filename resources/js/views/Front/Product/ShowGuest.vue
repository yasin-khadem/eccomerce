<template>
  <div class="container mt-5">
    <!--  محل نمایش محصول    -->
    <main-product-show
      :product="product"
    ></main-product-show>
  

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
import MainProductShow from "@/views/Front/Product/MainProductShow.vue";
export default {
  name: "ShowGuest",
    metaInfo() {
    return {
      title:  'خرید و سفارش' + ' ' + this.product.name + ' کد' + this.product.code,
    };
  },
  components: {
    Product,
    RelatedProducts,
    MainProductShow,
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
      
      product: {},
      slug: this.$route.params.slug,
      orderForm: false,
    };
  },
  computed: {
    showTitle() {
      return _.isEmpty(this.product.related_products) ? false : true;
    },
  },
  beforeCreate(){
    let user = localStorage.getItem('user');
    if(user){
      window.location.href = window.location.origin + "/product/show/" + this.$route.params.slug;
    }
  },
  created() {
        localStorage.removeItem('nextUrl');
    axios
      .get(`/api/product-guest/${this.slug}`)
      .then(({ data }) => {
        this.product = data;
      })
      .catch(({ response }) => {
        if (response.status === 404) this.$router.push({ name: "not-found" });
      });
    window.scrollTo(0, 0);
  },
  methods: {
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