<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TopIQ</title>
    @section('style')
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito:200,600">
      <link rel="stylesheet" type="text/css" href="/css/reset.css">
      <link rel="stylesheet" type="text/css" href="/css/common.css">
    @show
  </head>
  <body>
    @include('components.header')
    <div class="content">
      @yield('content')
    </div>
    @include('components.footer')
    @section('script')
      <script src="/js/lib/jquery-3.4.1.min.js"></script>
    @show
  </body>
</html>
