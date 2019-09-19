@extends('layouts.master')

@section('style')
@parent
<link rel="stylesheet" type="text/css" href="/css/verify_email.css">
@endsection
@section('content')
<div class="verify-wrapper">
  <div class="verify-content">
    <img id="verify-img" src="./img/icon-verify-email.svg" alt="icon-verify-email">
    <p id="verify-msg">Tài khoản của bạn đã được xác thực trước đó</p>
  </div>
</div>
@endsection