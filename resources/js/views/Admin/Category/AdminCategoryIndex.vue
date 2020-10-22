<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-between">
        <h5>لیست دسته بندی</h5>
        <router-link
          class="btn btn-create-category text-white"
          :to="{ name: 'admin-category', params: { url: 'create' } }"
        >
          <i class="fa fa-list-alt"></i>
          ایجاد دسته بندی جدید
        </router-link>
      </div>

      <div class="mt-3">
        <h4>جست و جو</h4>
        <div class="col-md-6 d-flex flex-row mb-3 search-input">
          <base-input name="search" v-model="form.search"></base-input>
          <base-btn :loading="searchLoading" @click="searchCategory" class="ml-2 mb-2">
            <i class="fa fa-search"></i>
          </base-btn>
        </div>
        <div class="mt-3 flex flex-row" v-if="refreshShowAll">
          <label class="my-1 mr-2">
            <h5><strong>نمایش همه</strong></h5>
          </label>
          <base-btn
            class="ml-2 mb-2 search-btn"
            :loading="refresh"
            @click="refreshCategories"
          >
            <i class="fas fa-sync"></i>
          </base-btn>
        </div>
      </div>
    </header>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">نام</th>
            <th scope="col" colspan="2" class="text-center">تغییرات</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(category, index) in categories.data" :key="category.id">
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
            <td class="text-center">
              <router-link
                :to="{
                  name: 'admin-category-edit',
                  params: { url: 'edit', slug: category.slug },
                }"
                class="btn btn-info"
                >ویرایش</router-link
              >
            </td>
            <td class="text-center">
              <button
                class="btn btn-danger"
                @click="deleteCategory(category.slug, index)"
              >
                حذف
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="categories"
        @pagination-change-page="getCategory"
        :limit="1"
      ></pagination>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
export default {
  name: "AdminCategoryIndex",
  metaInfo: {
    title: "لیست دسته بندی ها",
  },
  components: {
    Form,
  },
  data() {
    return {
      categories: {},
      refresh: false,
      searchLoading: false,
      form: new Form({
        search: null,
      }),
    };
  },
  computed: {
    refreshShowAll() {
      if (this.form.search || this.$route.query.search) {
        return true;
      }
    },
  },
  created() {
    this.form.search = this.$route.query.search;
    this.getCategory(this.$route.query.page);
  },
  methods: {
    getCategory(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      return this.$store
        .dispatch("category/getCategories", queries)
        .then(({ data }) => {
          this.categories = data;
          window.history.replaceState(
            "categories",
            "Categories",
            `/admin/category/index?${data.meta.queries}`
          );
        });
    },
    deleteCategory(slug, index) {
      swal.confirm().then((result) => {
        if (result.value) {
          this.$store
            .dispatch("category/deleteCategory", slug)
            .then(({ data }) => {
              this.categories.data.splice(index, 1);
            });
        }
      });
    },
    searchCategory() {
      let queries = this.$route.query;
      queries.search = this.form.search;
      this.searchLoading = true;
      this.getCategory().finally(() => {
        this.searchLoading = false;
      });
    },
    refreshCategories() {
      this.form.search = null;
      this.$route.query.search = null;
      this.refresh = true;
      this.getCategory(this.$route.query.page).finally(() => {
        this.refresh = false;
      });
    },
  },
};
</script>

<style scoped>
.btn-create-category {
  background-color: #43a047;
}
</style>