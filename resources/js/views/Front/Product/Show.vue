<template>
  <div class="container mt-5">
    <div class="card">
      <div class="row">
        <div class="col-md-4">
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
              <strong> قیمت: {{ formatToman(product.price) }}</strong>
            </h6>

            <a
              href="#"
              class="btn btn-primary up-show-card"
              @click.prevent="showOrderForm"
              v-if="ProductExist"
              >سفارش</a
            >
            <p v-if="!ProductExist" class="text-danger">
              <strong> این محصول قبلا فروخته شده </strong>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!--   فرم ثبت سفارش آدرش ، شماره تلفن ، کد پستی    -->
    <template v-if="orderForm">
      <div class="d-flex justify-content-center mt-5">
        <div class="card order-card text-white">
          <h3>ثبت سفارش</h3>
        </div>
      </div>
      <a href="#" class="down-show-card"></a>
      <div class="card mt-3 py-3 px-2">
        <div class="col-md-6 mx-auto">
          <div class="d-flex flex-column">
            <!-- <form action="/buy" method="POST"> -->
            <form @submit.prevent="continueToBuy">
              <base-input
                name="mobile_number"
                type="number"
                label="شماره موبایل"
                v-model="form.mobile_number"
              ></base-input>
              <base-input
                name="phone_number"
                type="number"
                label="شماره تلفن"
                v-model="form.phone_number"
              ></base-input>
              <base-input
                name="post_code"
                type="number"
                label="کد پستی"
                min="10"
                v-model="form.post_code"
              ></base-input>
              <base-input
                name="address"
                type="text"
                label="آدرس"
                v-model="form.address"
              ></base-input>
             
              <base-btn btn="success" :loading="form.busy"
                >ثبت و ادامه</base-btn
              >
            </form>
            <template v-if="showBuyBotton && checkForBuyButton">
              <form
                action="/buy"
                method="POST"
                class="d-flex justify-content-center mt-2"
                v-if="checkForBuyButton"
              >
                <input type="hidden" name="_token" :value="csrf" />
                <input
                  type="hidden"
                  name="product_id"
                  :value="form.product.id"
                />
                <input
                  type="hidden"
                  name="access_token"
                  :value="$store.state.auth.token"
                />
                <input type="hidden" name="price" :value="form.product.price" />

                <!-- orders table -->
                <input
                  type="hidden"
                  name="mobile_number"
                  :value="form.mobile_number"
                />
                <input
                  type="hidden"
                  name="phone_number"
                  :value="form.phone_number"
                />
                <input type="hidden" name="address" :value="form.address" />
                <input type="hidden" name="post_code" :value="form.post_code" />
                <!-- orders table -->

                <button class="btn btn-primary btn-round" v-if="formComplete">
                  خرید
                </button>
              </form>
            </template>
          </div>
          <ul class="mt-3">
            <li class="text-danger">
              <strong> لطفا کد پستی و آدرس را با دقت وارد کنید </strong>
            </li>
            <li class="text-danger">
              <strong
                >بعد از تکمیل فرم و ثبت اطلاعات ، دکمه خرید ظاهر میشود و با کلیک
                کردن روی آن به صفحه ی پرداخت وارد می شوید</strong
              >
            </li>
          </ul>
        </div>
      </div>
    </template>
    <!--   فرم ثبت سفارش آدرش ، شماره تلفن ، کد پستی    -->

    <div class="d-flex justify-content-center mt-5">
      <h3 v-if="showTitle">محصولات مربوطه</h3>
    </div>
    <hr />
    <div
      class="mt-3 row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 d-flex justify-content-center"
    >
      <div
        class="col mb-4"
        v-for="(product, index) in product.related_products"
        :key="product.id"
      >
        <Product :product="product" />
      </div>
    </div>
  </div>
</template>

<script>
import { formatTooman } from "prial";
import { Form } from "vform";
import Product from "@/components/Product.vue";

export default {
  name: "Show",
  metaInfo() {
    return {
      title: "محصول " + this.slug,
    };
  },

  components: {
    Product,
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
      form: new Form({
        product: {},
        phone_number: null,
        mobile_number: null,
        post_code: null,
        address: null,
      }),
      product: {},
      slug: this.$route.params.slug,
      orderForm: false,
      showBuyBotton: false,
      currentOrderData: {
        phone_number: null,
        mobile_number: null,
        post_code: null,
        address: null,
      }
    };
  },
  computed: {
    ProductExist() {
      return this.product.exist ? true : false;
    },
    showTitle() {
      return _.isEmpty(this.product.related_products) ? false : true;
    },
    csrf() {
      return window.csrf;
    },
    formComplete() {
      return this.form.address &&
        this.form.phone_number &&
        this.form.post_code &&
        this.form.mobile_number
        ? true
        : false;
    },
    checkForBuyButton(){
      if(this.currentOrderData.address ===  this.form.address &&
      this.currentOrderData.post_code === this.form.post_code &&
      this.currentOrderData.mobile_number === this.form.mobile_number &&
      this.currentOrderData.phone_number === this.form.address.phone_number){
        return true;
      }else{
        return false;
      }
    }
  },
  created() {
    axios
      .get(`/api/product/${this.slug}`)
      .then(({ data }) => {
        this.product = data;
        //test
        this.form.product = data;
        //end test
      })
      .catch((err) => this.$router.push({ name: "not-found" }));
  },
  methods: {
    showOrderForm() {
      this.orderForm = true;
      if ($(document).width() > 750) {
        window.scrollTo(0, 600);
      } else {
        swal.confirm("آیا مایل به ثبت سفارش هستید","info","برای ثبت سفارش تایید را بزنید").then((result) => {
          if (result.value) {
            window.scrollTo(0, 700);
          } else {
            this.orderForm = false;
          }
        });
      }
    },
    continueToBuy() {
      this.currentOrderData.address =  this.form.address
      this.currentOrderData.post_code = this.form.post_code
      this.currentOrderData.mobile_number = this.form.mobile_number
      this.currentOrderData.phone_number = this.form.address.phone_number
      if (this.formComplete) {
        return this.form
          .post(`/api/order`, this.form)
          .then(() => {
            this.showBuyBotton = true;
            swal.message(
              "با اطلاعاتی که وارد کردید خرید خود را انجام دهید",
              "success",
              2500
            );
          })
          .catch((e) => {
            this.showBuyBotton = false;
            swal.message("اطلاعات ثبت نشد", "error", 2500);
          });
      } else {
        swal.message("لطفا فرم را کامل کنید", "warning");
        this.showBuyBotton = false;
      }
    },
  }
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
</style>