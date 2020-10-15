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
            <base-input
              class=""
              name="search"
              placeholder="جست و جو"
              v-model="form.search"
            ></base-input>
            <base-btn
              class="ml-2 mb-2 search-btn"
              :loading="searchLoading"
              @click="searchProduct"
            >
              <i class="fa fa-search"></i>
            </base-btn>
          </div>
          <div class="flex flex-row" v-if="refreshShowAll">
          <label class="my-1 mr-2">
            <h5><strong>نمایش همه</strong></h5>
            </label>
            <base-btn
              class="ml-2 mb-2 search-btn"
              :loading="refresh"
              @click="refreshProduct"
            >
              <i class="fas fa-sync"></i>
            </base-btn>
          
          </div>
        </div>
        <div class="mx-auto">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">
            <h4><strong> مرتب سازی </strong></h4>
          </label>
          <select
            @change.prevent="onChange($event)"
            v-model="currentSortBy"
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
                  value="both"
                  @change.prevent="setExisting($event)"
                  v-model="currentExist"
                /><strong>همه</strong></label
              >
            </div>
            <div class="radio">
              <label
                ><input
                  type="radio"
                  class="mr-2"
                  name="optradio"
                  value="available"
                  @change.prevent="setExisting($event)"
                  v-model="currentExist"
                /><strong>موجود</strong></label
              >
            </div>
            <div class="radio disabled">
              <label
                ><input
                  type="radio"
                  class="mr-2"
                  name="optradio"
                  value="unavailable"
                  @change.prevent="setExisting($event)"
                  v-model="currentExist"
                /><strong>نا موجود</strong></label
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
        @pagination-change-page="fetchProducts"
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
    Form,
  },
  data() {
    return {
      // sortBy: 'newest',
      refresh:false,
      searchLoading: false,
      currentExist: "both",
      currentSortBy: "",
      formatToman: require("prial").formatToman,
      form: new Form({
        search: null,
      }),
    };
  },
  computed: {
    ...mapState("product", ["products"]),
    refreshShowAll(){
      if(this.form.search || this.$route.query.search){
        return true;
      }
    }
  },
  created() {
    let columns = ["expensive", "cheapest", "newest", "oldest"];
    let exists = ["available", "unavailable", "both"];
    let sortBy = this.$route.query.sortBy;
    this.currentSortBy = columns.includes(sortBy) ? sortBy : "newest";
    let existing = this.$route.query.existing;
    this.currentExist = exists.includes(existing) ? existing : "both";
    this.form.search = this.$route.query.search;
    this.fetchProducts(this.$route.query.page);
  },
  methods: {
    fetchProducts(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      queries.existing = this.currentExist;
      queries.sortBy = this.currentSortBy;
      return this.$store.dispatch("product/getUserProducts", queries);
    },
    refreshProduct(){
      this.form.search = null
      this.$route.query.search = null;
      this.refresh = true;
      this.fetchProducts(this.$route.query.page).finally(() => {
        this.refresh = false;
      });


    },
    onChange(event) {
      this.fetchProducts(this.$route.query.page);
    },
    setExisting() {
      this.fetchProducts(this.$route.query.page);
    },
    searchProduct() {
      let queries = this.$route.query;
      queries.search = this.form.search;
      this.searchLoading = true;
      this.fetchProducts(this.$route.query.page).finally(() => {
        this.searchLoading = false;
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
html[dir="rtl"] .custom-select {
  background-color: #0276fd;
}
.search-btn {
  background-color: #0276fd;
}
</style>
