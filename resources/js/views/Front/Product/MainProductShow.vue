<template>
  <div class="card">
    <div class="row">
      <div class="col-md-4">
     <!--   <div
          id="carousel-thumb"
          class="carousel slide carousel-fade carousel-thumbnails"
          data-ride="carousel"
        >
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img
                class="d-block w-100"
                src="/images/Red.jpg"
                alt="First slide"
              />
            </div>
            <div class="carousel-item">
              <img
                class="d-block w-100"
                src="/images/herriny.jpg"
                alt="Second slide"
              />
            </div>
            <div class="carousel-item">
              <img
                class="d-block w-100"
                src="/images/wakeley.jpg"
                alt="Third slide"
              />
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carousel-thumb"
            role="button"
            data-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carousel-thumb"
            role="button"
            data-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <ol class="carousel-indicators  pb-2 mr-5">
            <li data-target="#carousel-thumb" data-slide-to="0" class="active">
              <img
                class="d-block w-100 img-fluid"
                src="/images/Red.jpg"
              />
            </li>
            <li data-target="#carousel-thumb" data-slide-to="1">
              <img
                class="d-block w-100 img-fluid"
                src="/images/herriny.jpg"
              />
            </li>
            <li data-target="#carousel-thumb" data-slide-to="2">
              <img
                class="d-block w-100 img-fluid"
                src="/images/wakeley.jpg"
              />
            </li>
          </ol>
        </div> -->
        <img :src="'/' + product.image_src" class="card-img-top w-100" />  
      </div> 
      <div class="col-md-8">
        <div class="card-block p-3">
          <h4 class="card-title">نام محصول: {{ product.name }}</h4>
          <p class="card-text">
            <strong> کد: </strong>
            {{ product.code }}
          </p>
          <p class="card-text">
            <strong> توضیحات: </strong>
            {{ product.description }}
          </p>
          <h6 class="card-title">
            <strong> قیمت: {{ formatToman(parseInt(product.price)) }}</strong>
          </h6>
          <h6>
            <strong>دسته بندی:</strong>
          </h6>
          <div class="row ml-3">
            <router-link
              v-for="category in product.categories"
              :key="category.slug"
              class="mx-1"
              :to="{ name: 'home-tagged', params: { slug: category.slug } }"
            >
              <a class="badge badge-tags">{{ category.name }}</a>
            </router-link>
          </div>
          <template v-if="isLoggedIn">
            <a
              href="#"
              class="btn btn-primary up-show-card mt-3"
              @click.prevent="showOrderForm"
              v-if="ProductExist"
              >سفارش</a
            >
          </template>
          <template v-if="!isLoggedIn && ProductExist">
            <router-link
              :to="{ name: 'auth', params: { url: 'login' } }"
              class="btn btn-primary up-show-card mt-3"
            >
              سفارش
            </router-link>
          </template>
          <p v-if="!ProductExist" class="text-danger mt-3">
            <strong> این محصول قبلا فروخته شده </strong>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { formatTooman } from "prial";

export default {
  name: "MainProductShow",
  props: {
    product: {
      type: [Object, Array],
      required: true,
    },
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
    };
  },

  computed: {
    ...mapGetters("auth", ["user", "isLoggedIn"]),

    ProductExist() {
      return this.product.exist ? true : false;
    },
  },
  methods: {
    showOrderForm() {
      this.orderForm = true;
      this.$emit("setOrderForm", true);
      if ($(document).width() > 750) {
        window.scrollTo(0, 500);
      } else {
        swal
          .confirm(
            "آیا مایل به ثبت سفارش هستید",
            "info",
            "برای ثبت سفارش تایید را بزنید"
          )
          .then((result) => {
            if (result.value) {
              window.scrollTo(0, 700);
            } else {
              this.orderForm = false;
              this.$emit("setOrderForm", false);
            }
          });
      }
    },
  },
};
</script>

<style scoped>
.card {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  transition: 500ms;
}
.order-card {
  background-color: #9c27b0;
  padding: 0.35rem 0.75rem 0.15rem 0.75rem;
}
.badge-tags {
  background-color: #9c27b0;
  color: #fff;
  font-weight: 300;
  font-size: 15px;
}
</style>