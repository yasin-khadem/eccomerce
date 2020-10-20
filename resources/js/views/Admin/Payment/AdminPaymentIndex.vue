<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-center">
        <div class="card">
          <h5>لیست تراکنش ها</h5>
        </div>
      </div>

      <div class="mt-3">
        <h4>جست و جو</h4>
        <div class="col-md-6 d-flex flex-row mb-3 search-input">
          <base-input name="search" placeholder="بر اساس شناسه پرداخت یا کد محصول" v-model="form.search"></base-input>
          <base-btn @click="searchPayment" class="ml-2 mb-2">
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
            @click="refreshPayments"
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
            <th scope="col">نام کاربر</th>
            <th scope="col"># کاربر</th>
            <th scope="col"># سفارش</th>
            <th scope="col">کد محصول</th>
            <th scope="col"># محصول</th>
            <th scope="col">قیمت</th>
            <th scope="col">تاریخ پرداخت</th>
            <th scope="col">وضعیت</th>
            <th scope="col">شناسه پرداخت</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(payment, index) in payments.data" :key="payment.id">
            <td>{{ payment.id }}</td>
            <td>{{ payment.user.name }}</td>
            <td>{{ payment.user.id }}</td>
            <td>{{ payment.order_id }}</td>
            <td>{{ payment.product_code }}</td>
            <td>{{ payment.product_id }}</td>
            <td>{{ formatToman(payment.price) }}</td>
            <td>{{ moment(payment.created_at).format("jYYYY/jMM/jDD") }}</td>
            <td :class="[payment.is_paid ? 'text-success' : 'text-danger']">
              <strong>
                {{ payment.status }}
              </strong>
            </td>
            <td>{{ payment.ref_id }}</td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="payments"
        @pagination-change-page="getPayments"
        :limit="1"
      ></pagination>
    </div>
  </div>
</template>
<script>
import { Form } from "vform";
import { formatTooman } from "prial";
import moment from "moment-jalaali";
export default {
  name: "AdminPaymentIndex",
  components: {
    Form,
  },
  data() {
    return {
      refresh: false,
      searchLoading: false,
      form: new Form({
        search: null,
      }),
      payments: {},
      formatToman: require("prial").formatToman,
      moment,
    };
  },
  metaInfo: {
    title: "لیست تراکنش ها",
  },
  created() {
    this.form.search = this.$route.query.search;
    this.getPayments(this.$route.query.page);
  },
  computed: {
    refreshShowAll() {
      if (this.form.search || this.$route.query.search) {
        return true;
      }
    },
  },
  methods: {
    async getPayments(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      // let { data } = await axios.get(`/api/admin/payment?page=${page}`);
      let { data } = await axios.get(`/api/admin/payment`, {params: queries});
      window.history.replaceState(
        "payment",
        "Payment",
        // `/admin/payment/index?page=${page}`
        `/admin/payment/index?${data.meta.queries}`
      );
      this.payments = data;
    },
    searchPayment() {
      let queries = this.$route.query;
      queries.search = this.form.search;
      this.searchLoading = true;
      this.getPayments().finally(() => {
        this.searchLoading = false;
      });
    },
    refreshPayments() {
      this.form.search = null;
      this.$route.query.search = null;
      this.refresh = true;
      this.getPayments().finally(() => {
        this.refresh = false;
      });
    },
  },
};
</script>

<style scoped>
.card {
  background-color: #9c27b0;
  padding: 0.35rem 0.75rem 0.15rem 0.75rem;
  color: #fff;
}
.text-success {
  color: rgb(40, 153, 40) !important;
}
</style>