<template>
  <div>
    <div class="d-flex justify-content-center mt-3">
      <div class="card order-card text-white">
        <h3>ثبت سفارش</h3>
      </div>
    </div>
    <a href="#" class="down-show-card"></a>
    <div class="card mt-3 py-3 px-2">
      <div class="col-md-6 mx-auto">
        <div class="d-flex flex-column">
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

            <base-btn btn="success" :loading="form.busy">ثبت و ادامه</base-btn>
          </form>
          <template v-if="showBuyBotton && checkForBuyButton">
            <form
              action="/buy"
              method="POST"
              class="d-flex justify-content-center mt-2"
              v-if="checkForBuyButton"
            >
              <input type="hidden" name="_token" :value="csrf" />
              <input type="hidden" name="product_id" :value="product.id" />
              <input type="hidden" name="access_token" :value="token" />
              <input type="hidden" name="price" :value="product.price" />

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

              <button class="btn btn-primary btn-round" v-if="formComplete">
                خرید
              </button>
            </form>
          </template>
        </div>
        <div class="alert alert-danger mt-3">
        <ul>
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
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
export default {
  name: "OrderForm",
  props: { 
    formProduct: {
      type: [Object, Array],
      required: true,
    },
    product: {
      type: [Object, Array],
      required: true,
    },
  },
  data() {
    return {
      showBuyBotton: false,
      form: new Form({
        product: {},
        phone_number: null,
        mobile_number: null,
        post_code: null,
        address: null,
      }),
      currentOrderData: {
        phone_number: null,
        mobile_number: null,
        post_code: null,
        address: null,
      },
    };
  },
  created(){
    axios
      .get(`/api/product/${this.$route.params.slug}`)
      .then(({ data }) => {
        this.form.product = data;
        
      })
      .catch(({ response }) => {
        if (response.status === 404) this.$router.push({ name: "not-found" });
      });
  },
  methods: {
    continueToBuy() {
      this.currentOrderData.address = this.form.address;
      this.currentOrderData.post_code = this.form.post_code;
      this.currentOrderData.mobile_number = this.form.mobile_number;
      this.currentOrderData.phone_number = this.form.phone_number;
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
  },

  computed: {
    token() {
      return this.$store.state.auth.token;
    },
    formComplete() {
      return this.form.address &&
        this.form.phone_number &&
        this.form.post_code &&
        this.form.mobile_number
        ? true
        : false;
    },
    csrf() {
      return window.csrf;
    },
    checkForBuyButton() {
      if (
        this.currentOrderData.address === this.form.address &&
        this.currentOrderData.post_code === this.form.post_code &&
        this.currentOrderData.mobile_number === this.form.mobile_number &&
        this.currentOrderData.phone_number === this.form.phone_number
      ) {
        return true;
      } else {
        return false;
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
  background-color: #0276fd;
  padding: 0.35rem 0.75rem 0.15rem 0.75rem;
}
</style>