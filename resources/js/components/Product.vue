<template>
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
</template>

<script>
export default {
name:"Product",
props:['product']
}
</script>

<style>

</style>