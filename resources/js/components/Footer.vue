<template>
  <div class="mt-5">
      <div class="footer-top bg-dark text-white">
        <div class="row container">
          <div class="col-md-4 col-lg-4 footer-about my-3">
            <h4>درباره ما</h4>

            <p>
              We are a young company always looking for new and creative ideas
              to help you with our products in your everyday work.
            </p>
            <h5><router-link :to="{name: 'about-us'}" class="about-us ml-3">ادامه</router-link></h5>
          </div>
          <div class="col-md-4 col-lg-3 my-3 footer-social">
            <h4>مارا دنبال کنید</h4>
            <div class="mt-3">
              <div class="d-flex justify-content-start">
                <a href="#"><i class="fab fa-instagram fa-2x px-3"></i></a>
                <a href="#"><i class="fab fa-telegram fa-2x px-3"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 my-3 footer-contact">
            <h4>ارتباط با ما</h4>
            <p>
              <i class="fas fa-map-marker-alt fa-2x"></i> Via Rossini 10, 10136 Turin
              Italy
            </p>
            <p><i class="fas fa-phone fa-2x"></i> Phone: (0039) 333 12 68 347</p>
            <p>
              <i class="fas fa-envelope fa-2x"></i> Email:
              <a href="#">hello@domain.com</a>
            </p>
            <p><i class="fab fa-skype fa-2x"></i> Skype: you_online</p>
          </div>
        </div>
      </div>
    </div>
  
</template>

<script>
export default {
name:"Footer",

}
</script>

<style scoped>
  .about-us{
    color: rgb(50, 180, 255);
  }
</style>