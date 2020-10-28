<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-center">
        <h4 class="alert alert-dark">لیست خرید های شما</h4>
      </div>
    </header>
    <template v-if="showTable">
    <div  class="table-responsive">
      <table  class="table">
        <thead class="thead-dark">
          <tr>
            <th class="align-middle" scope="col">عکس</th>
            <th scope="col">نام محصول</th>
            <th scope="col">کد محصول</th>
            <th scope="col">مبلغ پرداختی</th>
            <th scope="col">تاریخ سفارش</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(purchase, index) in purchased.data" :key="purchase.id">
            <td>
              <img :src="'/' + purchase.image_src" width="100" alt="" />
            </td>
            <td class="align-middle">{{ purchase.product_name }}</td>
            <td class="align-middle">{{ purchase.product_code }}</td>
            <td class="align-middle">{{ formatToman(purchase.price) }}</td>
            <td class="align-middle">
              {{ moment(purchase.created_at).format("jYYYY/jMM/jDD") }}
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="purchased"
        @pagination-change-page="getPurchase"
        :limit="1"
      ></pagination>
    </div>
    </template>
  </div>
</template>

<script>
import moment from "moment-jalaali";
import { formatTooman } from "prial";

export default {
  name: "Purchased",
  metaInfo: {
    title: "لیست خرید های شما",
  },
  data() {
    return {
      moment,
      purchased: {},
      formatToman: require("prial").formatToman,
    };
  },
  created() {
    this.getPurchase(this.$route.query.page);
  },
  computed: {
    showTable() {
      return _.isEmpty(this.purchased.data) ? false : true
    }
  },
  methods: {
    getPurchase(page = 1) {
      axios.get(`/api/purchased?page=${page}`).then(({ data }) => {
        
          this.purchased = data;
          window.history.replaceState(
            "purchased",
            "Purchased",
            `/purchased/index?page=${page}`
          );
        if(_.isEmpty(this.purchased.data)){
          swal.message("هنوز خرید نکرده اید", "warning");
            window.history.back();
        }
      });
    },
  },
};
</script>

<style scoped>
</style>