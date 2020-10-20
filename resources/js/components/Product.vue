<template>
  <div class="card">
    <template v-if="isLoggedIn">
      <router-link
        :to="{
          name: 'product-show-slug',
          params: { slug: product.slug },
        }"
      >
        <img
          :src="'/' + product.image_src"
          class="card-img-top w-100"
          width="100"
        />
      </router-link>
    </template>  
    <template v-if="!isLoggedIn">
      <router-link
        :to="{
          name: 'product-show-slug-guest',
          params: { slug: product.slug },
        }"
      >
        <img
          :src="'/' + product.image_src"
          class="card-img-top w-100"
          width="100"
        />
      </router-link>
    </template>

    <div class="card-body">
     <template v-if="isLoggedIn">
        <router-link
          class="link-name-router"
          :to="{
            name: 'product-show-slug',
            params: { slug: product.slug },
          }"
        >
          <h5 class="card-title link-name">{{ product.name }}</h5>
        </router-link>
      </template>  
      <template v-if="!isLoggedIn">
        <router-link
          class="link-name-router"
          :to="{
            name: 'product-show-slug-guest',
            params: { slug: product.slug },
          }"
        >
          <h5 class="card-title link-name">{{ product.name }}</h5>
        </router-link>
      </template>   
      <h5 class="card-category mb-3">
        <small>
          کد:
          {{ product.code }}
        </small>
      </h5>
      <h6 class="card-title">
        <strong> {{ formatToman(product.price) }} </strong>
      </h6>
    </div>
    <div class="card-footer">
      <strong :class="[product.exist ? 'text-success' : 'text-danger']">{{
        product.is_exist
      }}</strong>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { formatTooman } from "prial";
export default {
  name: "Product",
  computed: {
    ...mapGetters("auth", ["user", "isLoggedIn"]),
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
    };
  },
  props: ["product"],
};
</script>

<style scoped>
.card:hover {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  transition: 500ms;
}
.link-name {
  color: black;
}
.link-name-router {
  text-decoration: none;
}
</style>