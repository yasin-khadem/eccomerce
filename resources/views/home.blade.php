<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>فروشگاه اینترنتی dorvangem | خرید سنگ های قیمتی و نیمه قیمتی و محصولات هنری</title>

  <meta name="description"
    content="فروشگاه اینترنتی dorvangem خرید سنگ های قیمتی و نیمه قیمتی و محصولات هنری + ارسال رایگان + قیمت مناسب">
    <meta name="name" content="فروشگاه اینترنتی dorvangem | خرید سنگ های قیمتی و نیمه قیمتی و محصولات هنری">
    <meta name="keywords"
      content="جواهرات.سنگهای قیمتی.قیمت مناسب.نقره.سنگ درمانی.فروشگاه اینترنتی.زیورآلات.انگشتر.گوشواره.تسبیح.مدال.گردنبند.زنجیر.دستبند.نگین.تابلو.نقاشی.آمتیست.لاجورد.مالاکیت.شجر.عقیق سلیمانی.سلیمانی.یشم.اونیکس.لابرادوریت.آویز.اسلایس.عقیق.خزه ای.عقیق خزه ای.دلربا.بهترین فروشگاه.مرجع خرید اینترنتی">
    <meta property="og:locale" content="fa_IR">
  <meta property="og:type" content="website">
  <meta property="og:title" content="فروشگاه اینترنتی dorvangem | خرید سنگ های قیمتی و نیمه قیمتی و محصولات هنری">


  <link href="/css/app.css" rel="stylesheet" />
  <style>
    html {
      scroll-behavior: smooth;
    }

    body {
      background-color: rgb(242, 242, 242)
    }

    .display-h {
      display: none;
    }
  </style>
  <script>
    window.csrf = '{{ csrf_token() }}';
  </script>
</head>

<body>
  @csrf
  <div id="app">
    <router-view :key="$route.fullPath"></router-view>
    <notify :data='@json(session('notify'))' />
  </div>
  <div class="display-h">
    <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
  </div>
  <script src="/js/app.js"></script>
</body>

</html>