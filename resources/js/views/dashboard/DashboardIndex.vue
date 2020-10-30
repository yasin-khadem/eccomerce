<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto mt-3">
        <!-- method 3 with cards  -->
        <div class="d-flex flex-row flex-wrap">
          <router-link
            v-for="(category, index) in categories.data"
            :key="category.id"
            class="card p-2 px-3 w-50 list-group-item-action"
            :to="{ name: 'home-tagged', params: { slug: category.slug } }"
          >
            {{ category.name }}
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DashboardIndex",
  metaInfo: {
    title: "دسته بندی محصولات",
  },
  data() {
    return {
      categories: {},
    };
  },
  async created() {
    await axios.get("/api/categories-guest").then(({ data }) => {
      this.categories = data;
    });
  },
};
</script>

<style>
</style>