<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TopIQ</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito:200,600">
    <link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/css/common.css">
    @yield('style')
  </head>
  <body>
    @include('components.header')
    <div class="content">
      @yield('content')
    </div>
    @include('components.footer')
    @yield('script')
  </body>
</html>
