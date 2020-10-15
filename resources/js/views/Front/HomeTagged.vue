<template>
  <div>
    <div class="d-flex justify-content-around mt-3">
      <h5 class=" ml-3 my-auto">
        <strong> دسته بندی {{ this.$route.params.slug }} </strong>
      </h5>
      <router-link :to="{ name: 'home' }" class="btn btn-primary mr-3"
        >صفحه اصلی</router-link
      >
    </div>
    <div class="container mt-4">
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
  </div>
</template>

<script>
import { formatTooman } from "prial";
import Product from "@/components/Product.vue";
import { mapState } from "vuex";
export default {
  name: "HomeTagged",
  metaInfo() {
    return {
      title: `محصولات دسته ${this.$route.params.slug} `,
    };
  },
  components: {
    Product,
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
      this.$store.dispatch("product/getTaggedProducts", {
        queries,
        params: this.$route.params,
      });
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


