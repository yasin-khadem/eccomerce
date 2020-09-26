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
      background-color: #eee
    }
  </style>
  <script>
    window.csrf = '{{ csrf_token() }}';

  </script>
</head>
<body>
  @csrf
    <div id="app">
        <router-view></router-view>
    </div>
  <script src="/js/app.js"></script>
</body>

</html>