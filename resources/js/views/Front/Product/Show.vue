<template>
  <div class="container mt-5">
    <div class="card">
      <div class="row">
        <div class="col-md-4">
          <img :src="'/' + product.image_src" class="card-img-top w-100" />
        </div>
        <div class="col-md-8">
          <div class="card-block p-3">
            <h4 class="card-title">نام محصول: {{ product.name }}</h4>
            <p class="card-text">
              <strong> کد: </strong>
              {{ product.code }}
            </p>
            <p class="card-text">
              <strong> توضیحات: </strong>
              {{ product.description }}
            </p>
            <h6 class="card-title">
              <strong> قیمت: {{ formatToman(product.price) }}</strong>
            </h6>

            <a href="#" class="btn btn-primary">سفارش</a>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
      <h3 v-if="showTitle">فایل های مربوطه</h3>
    </div>
    <div
      class="mt-5 row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 d-flex justify-content-center"
    >
      <div
        class="col mb-4"
        v-for="(product, index) in product.related_products"
        :key="product.id"
      >
        <Product :product="product" />
      </div>
    </div>
  </div>
</template>

<script>
import { formatTooman } from "prial";
import { Form } from "vform";
import Product from "@/components/Product.vue";

export default {
  name: "Show",
  metaInfo() {
    return {
      title: "محصول " + this.slug,
    };
  },
 
  components: {
    Product,
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
      form: new Form({}),
      product: {},
      slug: this.$route.params.slug,
    };
  },
  computed: {
    showTitle() {
      return _.isEmpty(this.product.related_products) ? false : true;
    },
  },
  created() {
    // this.$store
    // .dispatch("product/getUserProduct", this.slug)
    // .then((data) => {
    //   this.product = data;
    // })
    // .catch((err) => this.$router.push({ name: "not-found" }));
    axios
      .get(`/api/product/${this.slug}`)
      .then(({ data }) => {
        this.product = data;
      })
      .catch((err) => this.$router.push({ name: "not-found" }));
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