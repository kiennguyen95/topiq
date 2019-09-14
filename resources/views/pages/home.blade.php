@extends('layouts.master')

@section('style')
  @parent
  <link rel="stylesheet" type="text/css" href="/css/home.css">
@endsection
@section('content')
  <p>Home page</p>
@endsection
@section('script')
  @parent
  <script src="/js/lib/owl.carousel.min.js"></script>
  <script src="/js/home.js"></script>
@endsection