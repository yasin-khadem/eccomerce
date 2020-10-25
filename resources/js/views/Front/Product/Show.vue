<template>
  <div class="container mt-5">
    <!--  محل نمایش محصول    -->

    <main-product-show
      :product="product"
      @setOrderForm="setOrderForm"
    ></main-product-show>
    <!--  محل نمایش محصول    -->

    <!--   فرم ثبت سفارش آدرش ، شماره تلفن ، کد پستی    -->
    <order-form
      v-if="orderForm"
      :orderForm="orderForm"
      :formProduct="formProduct"
      :product="product"
    >
    </order-form>
    <!--   فرم ثبت سفارش آدرش ، شماره تلفن ، کد پستی    -->

    <!-- محل کامنت -->
    <div>
      <div class="form-group mt-5 col-md-6">
        <label for="comment">
          <h4>
            <strong> ثبت نظر: </strong>
          </h4>
        </label>
        <textarea
          name="comment"
          id="comment"
          placeholder="نظر خود را بنویسید..."
          class="form-control p-2"
          v-model="comment.body"
          cols="15"
          rows="7"
        ></textarea>
        <base-btn
          class="comment-btn mt-2"
          v-if="comment.body"
          :loading="comment.busy"
          @click="submitComment"
          >ثبت</base-btn
        >
      </div>
    </div>
    <div id="comments" class="my-5 pr-2 py-2" v-if="showComments">
      <product-comment
        v-for="comment in product.confirmed_comments"
        :key="comment.id"
        :comment="comment"
        @delete-comment="hideComment"
      ></product-comment>
    </div>
    <!-- محل کامنت -->

    <div class="d-flex justify-content-center mt-5">
      <h3 v-if="showTitle">محصولات مشابه</h3>
    </div>
    <hr />
    <related-products
      v-if="product.related_products"
      :product="product"
    ></related-products>
  </div>
</template>
<script>
import { formatTooman } from "prial";
import { Form } from "vform";
import { mapState } from "vuex";
import Product from "@/components/Product.vue";
import RelatedProducts from "@/views/Front/Product/RelatedProducts.vue";
import OrderForm from "@/views/Front/Product/OrderForm.vue";
import MainProductShow from "@/views/Front/Product/MainProductShow.vue";
import ProductComment from "@/views/Front/Product/ProductComment.vue";
export default {
  name: "Show",
  metaInfo() {
    return {
      title: "محصول " + this.slug,
    };
  },
  components: {
    Product,
    RelatedProducts,
    OrderForm,
    MainProductShow,
    ProductComment,
  },
  data() {
    return {
      formatToman: require("prial").formatToman,
      comment: new Form({
        body: null,
        product_id: null,
      }),
      product: {},
      slug: this.$route.params.slug,
      orderForm: false,
      formProduct: {},
    };
  },
  computed: {
    showTitle() {
      return _.isEmpty(this.product.related_products) ? false : true;
    },
    showComments() {
      return _.isEmpty(this.product.confirmed_comments) ? false : true;
    },
  },
  created() {
    localStorage.removeItem('nextUrl');
    axios
      .get(`/api/product/${this.slug}`)
      .then(({ data }) => {
        this.product = data;
        this.formProduct = data;
        this.comment.product_id = data.id;
      })
      .catch(({ response }) => {
        if (response.status === 404) this.$router.push({ name: "not-found" });
      });
    window.scrollTo(0, 0);
  },
  methods: {
    setOrderForm(event) {
      this.orderForm = event;
    },
    submitComment() {
      this.comment
        .post("/api/comment")
        .then(({ data }) => {
          swal.message("نظر شما پس از تایید ثبت میشود", "info", 3000);
          this.comment.body = null;
        })
        .catch((e) => {
          swal.message("نظر شما ارسال نشد", "error");
        });
    },
    hideComment(comment) {
      let index = this.product.confirmed_comments.indexOf(comment);
      this.product.confirmed_comments.splice(index, 1);
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
textarea {
  -webkit-box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.2);
}
.comment-btn {
  background-color: #2579ff;
}
#comments {
  background-color: #fff;
  -webkit-box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.2);
}
</style>