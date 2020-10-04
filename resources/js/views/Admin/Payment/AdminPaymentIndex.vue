<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-center">
        <div class="card">
          <h5>لیست تراکنش ها</h5>
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
import { formatTooman } from "prial";
import moment from "moment-jalaali";
export default {
  name: "AdminPaymentIndex",
  data() {
    return {
      payments: {},
      formatToman: require("prial").formatToman,
      moment,
    };
  },
  metaInfo:{
    title: 'لیست تراکنش ها'
  },
  created() {
    this.getPayments(this.$route.query.page);
  },

  methods: {
    async getPayments(page = 1) {
      let { data } = await axios.get(`/api/admin/payment?page=${page}`);
      window.history.pushState(
        "payment",
        "Payment",
        `/admin/payment/index?page=${page}`
      );
      this.payments = data;
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