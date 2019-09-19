@extends('layouts.master')

@section('style')
@parent
<link rel="stylesheet" type="text/css" href="/css/reset_pass.css">
@endsection
@section('content')
<div class="reset-pass-wrapper">
    <div class="reset-pass-content">
        <p id="reset-pass-title">Đổi mật khẩu cho tài khoản của bạn</p>
        <form id="reset-pass-form" action="/action_page.php">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">

            <label for="confirm-password">Nhập lại mật khẩu</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Nhập mật khẩu">
            <p id="message-error"></p>
            <br>
            <input type="submit" value="Xong">
        </form>
    </div>
</div>
@endsection
@section('script')
  @parent
  <script src="/js/reset_password.js"></script>
@endsection
