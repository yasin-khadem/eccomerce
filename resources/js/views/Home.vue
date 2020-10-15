<template>
  <div>
    <div>
      <div
        class="mt-3 mx-auto row row-cols-12 row-cols-sm-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12"
      >
      <div class="mx-auto mt-1">
        <label class="my-1 mr-2">
            <h4><strong>جست و جو</strong></h4>
          </label>
          <div class="d-flex flex-row">
          <base-input class="" name="search" placeholder="جست و جو" v-model="form.search"></base-input>
          <base-btn class="ml-2 mb-2 search-btn">
            <i class="fa fa-search"></i>
          </base-btn>
          </div>
        </div>
        <div class="mx-auto">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">
            <h4><strong> مرتب سازی </strong></h4>
          </label>
          <select
        
            dir="ltr"
            class="custom-select my-1 mr-sm-2 bg-select text-white"
            id="inlineFormCustomSelectPref"
          >
            <option value="expensive">گران ترین</option>
            <option value="cheapest">ارزان ترین</option>
            <option value="newest">جدید ترین</option>
            <option value="oldest">قدیمی ترین</option>
          </select>

          <div class="d-flex justify-content-around mt-3">
            <div class="radio">
              <label
                ><input
                  type="radio"
                  class="mr-2"
                  name="optradio"
                  checked
                />همه</label
              >
            </div>
            <div class="radio">
              <label
                ><input type="radio" class="mr-2" name="optradio" />موجود</label
              >
            </div>
            <div class="radio disabled">
              <label
                ><input type="radio" class="mr-2" name="optradio" />نا
                موجود</label
              >
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <div class="container mt-3">
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
import { Form } from "vform";
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
    Product,
    Footer,
    Form
  },
  data() {
    return {
      // sortBy: 'newest',
      formatToman: require("prial").formatToman,
          form: new Form({
            search: null
          })
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
      queries.sortBy = this.sortBy;
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
html[dir="rtl"] .custom-select {
  background-color: #0276fd;
}
.search-btn{
    background-color: #0276fd;

}
</style>
