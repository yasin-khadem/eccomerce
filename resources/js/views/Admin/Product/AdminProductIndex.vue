<template>
  <div class="container">
    <header class="mt-3 mb-4">
      <div class="d-flex justify-content-between">
        <h5>لیست محصولات</h5>
        <router-link
          class="btn btn-create-product text-white"
          :to="{ name: 'admin-product', params: { url: 'create' } }"
        >
          <i class="fa fa-shopping-cart"></i>
          ثبت محصول جدید
        </router-link>
      </div>
    </header>
    <h5 class="mb-2 ml-3">جستجو</h5>
    <div class="col-md-6 d-flex flex-row mb-3 search-input">
      <base-input name="search" placeholder="براساس کد ، نام و توضیحات محصول" v-model="form.search"></base-input>
      <base-btn
        :loading="searchLoading"
        @click="searchProduct"
        class="ml-2 mb-1"
      >
        <i class="fa fa-search"></i>
      </base-btn>
    </div>
    <div class="flex flex-row ml-3 mb-2" v-if="refreshShowAll">
      <label class="mr-2">
        <h5><strong>نمایش همه</strong></h5>
      </label>
      <base-btn
        class="ml-2 search-btn"
        :loading="refresh"
        @click="refreshProduct"
      >
        <i class="fas fa-sync"></i>
      </base-btn>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" @click="changeSortBy('id')">
              <i
                class="fa text-info"
                :class="sortdirection"
                v-show="currentSortBy === 'id'"
              ></i>
              #
            </th>
            <th
              class="table-heading-padding text-center"
              scope="col"
              @click="changeSortBy('name')"
            >
              <i
                class="fa text-info"
                :class="sortdirection"
                v-show="currentSortBy === 'name'"
              ></i>
              نام
            </th>
            <th
              class="table-heading-padding text-center"
              scope="col"
              @click="changeSortBy('code')"
            >
              <i
                class="fa text-info"
                :class="sortdirection"
                v-show="currentSortBy === 'code'"
              ></i>
              کد محصول
            </th>
            <th
              class="table-heading-padding text-center"
              scope="col"
              @click="changeSortBy('price')"
            >
              <i
                class="fa text-info"
                :class="sortdirection"
                v-show="currentSortBy === 'price'"
              ></i>
              قیمت
            </th>
            <th
              class="table-heading-padding text-center"
              scope="col"
              @click="changeSortBy('description')"
            >
              <i
                class="fa text-info"
                :class="sortdirection"
                v-show="currentSortBy === 'description'"
              ></i>
              توضیحات
            </th>
            <th
              class="table-heading-padding text-center"
              scope="col"
              @click="changeSortBy('exist')"
            >
              <i
                class="fa text-info"
                :class="sortdirection"
                v-show="currentSortBy === 'exist'"
              ></i>
              وضعیت
            </th>
            <th
              class="table-heading-padding text-center"
              scope="col"
              @click="changeSortBy('created_at')"
            >
              <i
                class="fa text-info"
                :class="sortdirection"
                v-show="currentSortBy === 'created_at'"
              ></i>
              تاریخ ثبت
            </th>
            <th
              class="table-heading-padding text-center"
              scope="col"
              colspan="2"
            >
              تغییرات
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, index) in products.data" :key="product.id">
            <td>{{ product.id }}</td>
            <td class="text-center">{{ product.name }}</td>
            <td class="text-center">{{ product.code }}</td>
            <td class="text-center">{{ formatToman(product.price) }}</td>
            <td class="text-center">{{ product.description }}</td>
            <td
              class="text-center"
              :class="[product.exist ? 'text-success' : 'text-danger']"
            >
              <strong> {{ product.is_exist }} </strong>
            </td>
            <td class="text-center">
              {{ moment(product.created_at).format("jYY/jM/jD") }}
            </td>
            <td>
              <router-link
                class="btn btn-info"
                :to="{
                  name: 'admin-product-edit',
                  params: { url: 'edit', slug: product.slug },
                }"
                >ویرایش</router-link
              >
            </td>
            <td>
              <button
                class="btn btn-danger"
                @click="deleteProduct({ slug: product.slug, index: index })"
              >
                حذف
              </button>
              <!--       <a class="btn btn-secondary" :href="`/mytest?access_token=${$store.state.auth.token}`">test</a>  -->
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="products"
        @pagination-change-page="getProducts"
        :limit="1"
      ></pagination>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import { Form } from "vform";
import { formatTooman } from "prial";

import moment from "moment-jalaali";
export default {
  name: "AdminProductIndex",
  metaInfo: {
    title: "لیست محصولات",
  },
  data() {
    return {
      refresh: false,
      moment,
      currentSortBy: null,
      currentSortDir: null,
      searchLoading: false,
      form: new Form({
        search: null,
      }),
      formatToman: require("prial").formatToman,
    };
  },
  created() {
    let columns = [
      "id",
      "name",
      "code",
      "price",
      "description",
      "exist",
      "created_at",
    ];
    let dir = ["asc", "desc"];

    let sortBy = this.$route.query.sortBy;
    let sortDir = this.$route.query.sortDir;
    this.currentSortBy = columns.includes(sortBy) ? sortBy : "id";
    this.currentSortDir = dir.includes(sortDir) ? sortDir : "desc";
    this.form.search = this.$route.query.search;
    this.getProducts(this.$route.query.page);
  },
  computed: {
    ...mapState("product", ["products"]),
    sortdirection() {
      return this.currentSortDir === "asc" ? "fa-arrow-down" : "fa-arrow-up";
    },
    refreshShowAll() {
      if (this.form.search || this.$route.query.search) {
        return true;
      }
    },
  },

  methods: {
    ...mapActions("product", ["deleteProduct"]),
    getProducts(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      queries.sortBy = this.currentSortBy;
      queries.sortDir = this.currentSortDir;
      return this.$store.dispatch("product/getProducts", queries);
    },
    refreshProduct() {
      let queries = this.$route.query;
      queries.search = null;
      this.form.search = null;
      this.currentSortBy = "id";
      this.currentSortDir = "desc";
      this.refresh = true;
      this.getProducts().finally(() => {
        this.refresh = false;
      });
    },
    changeSortBy(sortBy) {
      if (this.currentSortBy === sortBy) {
        this.currentSortDir = this.currentSortDir === "desc" ? "asc" : "desc";
      }
      this.currentSortBy = sortBy;
      this.getProducts(this.$route.query.page);
    },
    searchProduct() {
      let queries = this.$route.query;
      queries.search = this.form.search;
      this.searchLoading = true;
      this.getProducts().finally(() => {
        this.searchLoading = false;
      });
    },
  },
};
</script>

<style scoped>
.btn-create-product {
  background-color: #43a047;
}
.table-heading-padding {
  padding-right: 2.5rem;
  padding-left: 2.5rem;
}
th {
  cursor: pointer;
}
</style>