<template>
  <div class="container mt-2 col-md-6">
    <div class="pt-2 pr-4 pl-2 alert alert-secondary mt-3">
      <div class="container">
        <ul>
          <li class="mb-3 mt-1">
            <p>
              <strong>
                گروه هنری دروان جم تلاش دارد با معرفی محصولات هنری اصیل و دست
                ساز در راستای توسعه و ترویج هنر سنتی و مدرن با ارائه دست سازه
                های زیبا در جهت رضایت خریدار گام بردارد.
              </strong>
            </p>
          </li>
          <li class="my-3">
            <p>
              <strong>
                ارسال محصولات خریداری شده توسط شما به وسیله ی پست انجام میشود
                (محصولات دارای ابعاد بزرگ فقط در شهر های
                <p class="city">تهران</p>
                و
                <p class="city">کرج</p>

                و شهرک های هم جوار قابل ارسال میباشد)
              </strong>
            </p>
          </li>
          <li class="my-3">
            <p>
              <strong>
                هزینه ارسال برای خریدار رایگان میباشد. محصولات خریداری شده تا 48
                ساعت قابل عودت میباشد.
              </strong>
            </p>
          </li>
          <li class="my-3">
            <p>
              <strong>
                شماره‌ تماس در بخش پایین صفحه اصلی درج شده. شما میتوانید با بخش
                پشتیبانی تماس گرفته و سوالات خود را بپرسید
              </strong>
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AboutUs",

  metaInfo: {
    title: "درباره ما",
    meta: [
      {
        name: "description",
        content:
          "درباره ما",
      },
    ],
  },
  created() {
    localStorage.removeItem("nextUrl");
  },
};
</script>

<style scoped>
p {
  line-height: 1.7;
  color: #343a40;
}
ul li {
  color: #9b27b0;
}
.city {
  color: red;
  display: inline;
}
</style>