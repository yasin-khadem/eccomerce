<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-between">
        <h5>لیست دسته بندی ها</h5>
        <router-link
          class="btn btn-create-category text-white"
          :to="{name: 'admin-category' , params:{url:'create'}}"
        >
          <i class="fa fa-user-plus"></i>
          ایجاد دسته بندی جدید
        </router-link>
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
          <tr v-for="(category,index) in categories.data" :key="category.id">
            <td>{{category.id}}</td>
            <td>{{category.name}}</td>
            <td  class="text-center">
              <router-link 
                :to="{name:'admin-category-edit',params:{url:'edit',slug:category.slug}}"
                class="btn btn-info"
              >ویرایش</router-link>
            </td>
            <td  class="text-center">
              <button class="btn btn-danger" @click="deleteCategory(category.slug,index)">حذف</button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :data="categories" @pagination-change-page="getCategory" :limit="1"></pagination>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminCategoryIndex",
  metaInfo: {
    title: "لیست دسته بندی ها",
  },
  data() {
    return {
      categories: {},
    };
  },
  created() {
    this.getCategory(this.$route.query.page);
  },
  methods: {
    getCategory(page = 1) {
      this.$store.dispatch("category/getCategories", page).then(({ data }) => {
        this.categories = data;
        window.history.pushState(
          "categories",
          "Categories",
          `/admin/category/index?page=${page}`
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
  },
};
</script>

<style scoped>
.btn-create-category {
  background-color: #43a047;
}
</style>