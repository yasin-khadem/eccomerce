<template>
  <div class="card width-80 mx-auto">
    <div class="row">
      <div class="col-md-4">
        <template v-if="ShowCarousel">
          <div
            id="carousel-thumb"
            class="carousel slide carousel-fade carousel-thumbnails"
            data-ride="carousel"
          >
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <a :href="'/' + product.image_src">
                  <img
                    class="d-block w-100"
                    :src="'/' + product.image_src"
                    :alt="product.name + ' ' + product.description"
                  />
                </a>
              </div>

              <div
                v-for="(item, index) in product.related_images"
                :key="item.id"
                class="carousel-item"
              >
                <a :href="'/' + item.gallery_src">
                  <img
                    class="d-block w-100"
                    :src="'/' + item.gallery_src"
                    :alt="item.description"
                  />
                </a>
              </div>
            </div>
            <a
              class="carousel-control-prev"
              href="#carousel-thumb"
              role="button"
              data-slide="prev"
            >
              <div class="slider-background-prev">
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
              </div>
              <span class="sr-only">Previous</span>
            </a>
            <a
              class="carousel-control-next"
              href="#carousel-thumb"
              role="button"
              data-slide="next"
            >
              <div class="slider-background-next">
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
              </div>
              <span class="sr-only">Next</span>
            </a>
            <ol class="carousel-indicators pb-2 mr-5">
              <li
                data-target="#carousel-thumb"
                data-slide-to="0"
                class="active"
              >
                <img
                  class="d-block w-100 img-fluid"
                  :src="'/' + product.image_src"
                  :alt="product.name + ' ' + product.description"
                />
              </li>
              <li
                v-for="(item, index) in product.related_images"
                :key="item.id"
                data-target="#carousel-thumb"
                :data-slide-to="index + 1"
              >
                <img
                  class="d-block w-100 img-fluid"
                  :src="'/' + item.gallery_src"
                  :alt="item.description"
                />
              </li>
            </ol>
          </div>
        </template>
        <template v-if="!ShowCarousel">
          <a :href="'/' + product.image_src">
            <img
              :src="'/' + product.image_src"
              class="card-img-top w-100"
              :alt="product.name + ' ' + product.description"
            />
          </a>
        </template>
      </div>
      <div class="col-md-8">
        <div class="card-block p-3">
          <h4 class="card-title">نام محصول: {{ product.name }}</h4>
          <div class="card-text">
            <div>
              <strong> کد: </strong>
              {{ product.code }}
            </div>
            <div class="mt-1">
              <strong> توضیحات: </strong>
              {{ product.description }}
            </div>

            <div class="my-2">
              <h6>
                <strong>
                  قیمت: {{ formatToman(parseInt(product.price)) }}</strong
                >
              </h6>
            </div>
            <h6>
              <strong> برچسب ها: </strong>
              (برای دیدن محصولات مشابه روی برچسب ها کلیک کنید)
            </h6>
          </div>
          <div class="row ml-3">
            <router-link
              v-for="category in product.categories"
              :key="category.slug"
              class="mx-1 margin-badge"
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
            <button
              @click.prevent="redirectToLogin"
              class="btn btn-primary up-show-card mt-3"
            >
              سفارش
            </button>
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
    ShowCarousel() {
      return _.isEmpty(this.product.related_images) ? false : true;
    },
    ProductExist() {
      return this.product.exist ? true : false;
    },
  },
  methods: {
    redirectToLogin() {
      localStorage.setItem(
        "nextUrl",
        window.location.origin + "/product/show/" + this.product.slug
      );
      swal.message("برای سفارش باید وارد سایت شوید", "warning", 2700);
      this.$router.push({ name: "auth", params: { url: "login" } });
    },
    showOrderForm() {
      this.orderForm = true;
      window.scrollTo(0, 0);

      this.$emit("setOrderForm", true);
      if ($(document).width() > 750) {
        window.scrollTo(0, 400);
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
.slider-background-prev {
  height: 30px;
  width: 30px;
  padding: 5px 3px 6px 2px;
  background-color: black;
  border-radius: 50%;
}
.slider-background-next {
  height: 30px;
  width: 30px;
  padding: 4px 3px 6px 6px;
  background-color: black;
  border-radius: 50%;
}
.width-80 {
  width: 85%;
}
.margin-badge {
  margin: 1px 0;
}
</style>