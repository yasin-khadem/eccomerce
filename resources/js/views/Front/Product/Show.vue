<template>
  <div class="container mt-5">
    <div class="card">
      <div class="row">
        <div class="col-md-4">
          <img
            :src="'/'+product.image_src"
            class="card-img-top w-100"
          />
        </div>
        <div class="col-md-8">
          <div class="card-block p-3">
            <h4 class="card-title">نام محصول: {{ product.name }}</h4>
            <p class="card-text">
              کد:
              {{ product.code }}
            </p>
            <p class="card-text">
              توضیحات:
              {{ product.description }}
            </p>
            <h6 class="card-title">
              قیمت:
              <strong> {{ formatToman(product.price) }}</strong>
            </h6>

            <a href="#" class="btn btn-primary">سفارش</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { formatTooman } from "prial";
import { Form } from "vform";

export default {
  name: "Show",
  metaInfo() {
    return {
      title: "محصول " + this.slug,
    };
  },
  data() {
    return {
      formatToman : require('prial').formatToman,
      form: new Form({}),
      product: {},
      slug: this.$route.params.slug,
    };
  },
  created() {
      this.$store.dispatch('product/getUserProduct',this.slug).then((data)=>{
          this.product = data
      }).catch(err=> this.$router.push({name: "not-found"}))
    //  axios.get(`/api/product/${this.slug}`).then(({ data }) => {
    //   this.product = data;
    // });
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

</style>