<template>
  <div class="container-fluid">
    <header class="my-3">
      <div class="d-flex justify-content-center">
        <div class="card">
          <h5>لیست سفارش ها</h5>
        </div>
      </div>
    </header>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col"># مشتری</th>
            <th scope="col">نام مشتری</th>
            <th scope="col"># پرداخت</th>
            <th scope="col">نام محصول</th>
            <th scope="col">کد محصول</th>
            <th class="heading-padding text-center" scope="col">آدرس</th>
            <th scope="col">شماره موبایل</th>
            <th scope="col">شماره تلفن</th>
            <th scope="col">کد پستی</th>
            <th scope="col">وضعیت ارسال</th>
            <th scope="col">تاریخ سفارش</th>
            <th scope="col">تغییرات</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(order, index) in orders.data" :key="order.id">
            <td>{{ order.id }}</td>
            <td>{{ order.user_id }}</td>
            <td>{{ order.customer_name }}</td>
            <td>{{ order.payment_id }}</td>
            <td>{{ order.product_name }}</td>
            <td>{{ order.product_code }}</td>
            <td>{{ order.address }}</td>
            <td>{{ order.mobile_number }}</td>
            <td>{{ order.phone_number }}</td>
            <td>{{ order.post_code }}</td>
            <td :class="[order.delivered ? 'text-success' : 'text-danger']">
              <strong>
                {{ order.is_delivered }}
              </strong>
            </td>
            <td>{{ moment(order.created_at).format("jYYYY/jMM/jDD") }}</td>
            <td>
              <button
                class="btn btn-warning"
                :disabled="order.delivered ? true : false"
                @click.prevent="sendingProduct(order.slug, index)"
              >
                فرستاده شد
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="orders"
        @pagination-change-page="getOrders"
        :limit="1"
      ></pagination>
    </div>
  </div>
</template>

<script>
import moment from "moment-jalaali";
export default {
  name: "AdminOrderIndex",
  metaInfo: {
    title: "لیست سفارش ها",
  },
  data() {
    return {
      orders: {},
      moment,
    };
  },
  created() {
    this.getOrders(this.$route.query.page);
  },
  computed: {},
  methods: {
    getOrders(page = 1) {
      axios.get(`/api/admin/order?page=${page}`).then(({ data }) => {
        this.orders = data;
        window.history.pushState(
          "orders",
          "Orders",
          `/admin/order/index?page=${page}`
        );
      });
    },
    sendingProduct(slug, index) {
      swal
        .confirm(
          "آیا محصول را ارسال کرده اید؟",
          "warning",
          "اگر مطمئن نیستید دوباره بررسی کنید"
        )
        .then((result) => {
          if (result.value) {
            axios.patch(`/api/admin/order/deliver/${slug}`).then(() => {
              this.getOrders(this.$route.query.page);
            });
          }
        });
    },
  },
};
</script>

<style scoped>
.card{
   background-color: #9c27b0;
  padding: 0.35rem 0.75rem 0.15rem 0.75rem;
  color: #fff;
}
.heading-padding{
  padding: 1rem 3rem;
}
</style>