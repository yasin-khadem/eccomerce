<template>
  <div>
    <div class="container mt-5">
      <div
        class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5"
      >
        <div
          class="col mb-4"
          v-for="(product, index) in products.data"
          :key="product.id"
        >
          <Product :product="product" />
        </div>
      </div>
      <pagination
        :data="products"
        @pagination-change-page="fetchProduts"
        :limit="1"
      ></pagination>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import { formatTooman } from "prial";
import Product from "@/components/Product.vue";
import Footer from "@/components/Footer.vue";
import { mapState } from "vuex";
export default {
  name: "Home",
  metaInfo: {
    title: "صفحه اصلی",
  },
  components: {
    Product,Footer
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
    };
  },
  computed: {
    ...mapState("product", ["products"]),
  },
  created() {
    this.fetchProduts(this.$route.query.page);
  },
  methods: {
    fetchProduts(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      this.$store.dispatch("product/getUserProducts", queries);
    },
  },
};
</script>

<style scoped>
.card:hover {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  transition: 500ms;
}
.card {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  transition: 500ms;
}
</style>
