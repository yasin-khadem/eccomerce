<template>
  <div class="mt-5">
    <div class="footer-top bg-dark text-white">
      <div class="row container">
        <div class="col-md-6 col-lg-3 footer-about my-3">
          <h4>درباره ما</h4>

          <p>
            گروه هنری دروان جم تلاش دارد با معرفی محصولات هنری اصیل و دست ساز در
            راستای توسعه و ترویج هنر سنتی و مدرن با ارائه دست سازه های زیبا در
            جهت رضایت خریدار گام بردارد...
          </p>
          <h5>
            <router-link :to="{ name: 'about-us' }" class="about-us ml-3"
              >ادامه</router-link
            >
          </h5>
        </div>
        <div class="col-md-6 col-lg-3 my-3 footer-social">
          <h4>مارا دنبال کنید</h4>
          <div class="mt-3">
            <div class="d-flex justify-content-start">
              <a href="https://www.instagram.com/dorvangem/?hl=en"
                ><i class="fab fa-instagram fa-2x px-3"></i
              ></a>
              <a href="https://t.me/dorvangem"
                ><i class="fab fa-telegram fa-2x px-3"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 my-3 zarinpal">
          <h4>پرداخت امن با نماد اعتماد</h4>
          <a href="javascript:showZPTrust();" title="دروازه پرداخت معتبر"
            ><img
              src="https://cdn.zarinpal.com/badges/trustLogo/1.svg"
              border="0"
              alt="دروازه پرداخت معتبر"
          /></a>
        </div>
        <div class="col-md-6 col-lg-3 my-3 footer-contact">
          <h4>ارتباط با ما</h4>
         
          <p><i class="fas fa-phone fa-2x"></i> تماس: 09122604129</p>
          <p>
            <i class="fas fa-envelope fa-2x"></i> ایمیل:
            <a>dorvangem@gmail.com</a>
          </p>
           <p>
            <i class="fas fa-map-marker-alt fa-2x"></i> ایران ، البرز ، کرج
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style scoped>
.about-us {
  color: rgb(50, 180, 255);
}
.zarinpal {
  margin: auto;
}
.zarinpal img {
  width: 90px;
}
</style>