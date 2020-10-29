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
          :alt="product.name + ' ' + product.description"
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
          :alt="product.name + ' ' + product.description"
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
          <h3 class="card-title link-name">
            <small>{{ product.name }}</small>
          </h3>
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
          <h3 class="card-title link-name">
            <small>
              {{ product.name }}
            </small>
          </h3>
        </router-link>
      </template>
      <h4 class="card-category mb-3">
        <small>
          کد:
          {{ product.code }}
        </small>
      </h4>
      <h4 class="card-title">
        <small>
          <strong> {{ formatToman(product.price) }} </strong>
        </small>
      </h4>
    </div>
    <div class="card-footer">
      <h4>
        <small>
          <strong :class="[product.exist ? 'text-success' : 'text-danger']">{{
            product.is_exist
          }}</strong>
        </small>
      </h4>
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
  props: ["product"],
  data() {
    return {
      formatToman: require("prial").formatToman,
    };
  },
  created() {},
  methods: {},
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