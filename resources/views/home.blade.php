<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ecommerce</title>
  <link href="/css/app.css" rel="stylesheet" />
  <style>
    html {
    scroll-behavior: smooth;
    }
    body{
      background-color:rgb(242, 242, 242)
    }
    .display-h{
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