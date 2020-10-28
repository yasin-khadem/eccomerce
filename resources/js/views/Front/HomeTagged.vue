<template>
  <div>
    <!-- test -->
    <div
      class=" mx-auto row row-cols-12 row-cols-sm-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12"
    >
    <div class="mx-auto  mt-5">
      <h4 class="alert alert-primary">
        <strong> دسته بندی {{ this.$route.params.slug }} </strong>
      </h4>
    </div>
      <div class="mx-auto mt-1">
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
    

    <!-- test -->
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
        @pagination-change-page="fetchProducts"
        :limit="1"
      ></pagination>
    </div>

    <div class="d-flex justify-content-center mb-5">
      <router-link class="btn btn-custome" :to="{name: 'home'}">صفحه اصلی</router-link>
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
      currentExist: "both",
      currentSortBy: "",
      formatToman: require("prial").formatToman,
    };
  },
  computed: {
    ...mapState("product", ["products"]),
  },
  created() {
    let columns = ["expensive", "cheapest", "newest", "oldest"];
    let exists = ["available", "unavailable", "both"];
    let sortBy = this.$route.query.sortBy;
    this.currentSortBy = columns.includes(sortBy) ? sortBy : "newest";
    let existing = this.$route.query.existing;
    this.currentExist = exists.includes(existing) ? existing : "both";
    this.fetchProducts(this.$route.query.page);
  },
  methods: {
    fetchProducts(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      queries.existing = this.currentExist;
      queries.sortBy = this.currentSortBy;
      return this.$store.dispatch("product/getTaggedProducts", {
        queries,
        params: this.$route.params,
      });
    },
    onChange(event) {
      this.$route.query.page = 1;
      this.fetchProducts(this.$route.query.page);
    },
    setExisting() {
      this.$route.query.page = 1;
      this.fetchProducts(this.$route.query.page);
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
.card{
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  transition: 500ms;
}
.alert{
    -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
}
html[dir="rtl"] .custom-select {
  background-color: #0276fd;
}

.btn-custome{
  background-color: #0276fd;
  color: #fff;
}
</style>


