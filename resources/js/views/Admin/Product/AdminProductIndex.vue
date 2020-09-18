<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-between">
        <h5>لیست محصولات</h5>
        <router-link
          class="btn btn-create-product text-white"
          :to="{name: 'admin-product' , params:{url:'create'}}"
        >
          <i class="fa fa-user-plus"></i>
          ثبت محصول جدید
        </router-link>
      </div>
    </header>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">نام</th>
            <th scope="col">کد محصول</th>
            <th scope="col">قیمت</th>
            <th scope="col">توضیحات</th>
            <th scope="col">تاریخ ثبت</th>
            <th scope="col" colspan="2" class="text-center">تغییرات</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product,index) in products.data" :key="product.id">
            <td>{{product.id}}</td>
            <td>{{product.name}}</td>
            <td>{{product.code}}</td>
            <td>{{product.price}}</td>
            <td>{{product.description}}</td>
            <td>{{product.created_at}}</td>
            <td>
              <router-link
                class="btn btn-info"
                :to="{name: 'admin-product-edit' , params:{url:'edit',slug:product.slug}}"
              >ویرایش</router-link>
            </td>
            <td>
              <button class="btn btn-danger" @click="deleteProduct({slug:product.slug ,index:index })">حذف</button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :data="products" @pagination-change-page="getProducts"></pagination>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  name: "AdminProductIndex",
  metaInfo: {
    title: "لیست محصولات",
  },
 
  created() {
    this.getProducts(this.$route.query.page);
  },
  computed: {
    ...mapState("product", ["products"]),
  },
  methods: {
    ...mapActions("product", ["getProducts","deleteProduct"]),
    
  },
};
</script>

<style>
.btn-create-product {
  background-color: #43a047;
}
</style>