<template>
  <div class="container mt-5">
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
      <div class="col mb-4" v-for="(product,index) in products.data" :key="product.id">
        <div class="card">
          <img
            src="https://mdbootstrap.com/img/Photos/Square/img(6).jpg"
            class="card-img-top w-100"
            width="100"
          />
          <div class="card-body">
            <h5 class="card-title">{{product.name}}</h5>
            <h5 class="card-category mb-3">
              <small>
              کد:
              {{product.code}}
              </small>
            </h5>
            <h6 class="card-title">
            <strong>
              {{product.price}} تومان
            </strong>
            </h6>
            <h6 class="card-category">
              <small>دسته بندی</small>
            </h6>
          </div>
          <div class="card-footer">
            <div class="stats">
              <strong :class="[product.exist ? 'text-success': 'text-danger'  ]">{{product.is_exist}}</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: "Home",
  metaInfo: {
    title: "صفحه اصلی",
  },
  data() {
    return {
      items:10
    };
  },
  computed: {
    ...mapState('product',['products']),
    existColor(id){
      if(products[id].exist){
        return 'text-success';
      }else{
        return 'text-danger';

      }
    }
   
  },
  created(){
    this.$store.dispatch('product/getUserProducts')
  }
};
</script>

<style scoped>
.card:hover {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.49);
  transition: 500ms;
}
.card {
  -webkit-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 0px 12px 4px rgba(0, 0, 0, 0.25);
  transition: 500ms;
}

</style>
