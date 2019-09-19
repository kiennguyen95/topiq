@extends('layouts.master')

@section('style')
@parent
<link rel="stylesheet" type="text/css" href="/css/top_up.css">
@endsection
@section('content')
<div class="top-up-wrapper">

  <div class="top-up-content">

    <p id="top-up-greeting">Chào bạn tsukasa, mời bạn nạp thẻ</p>


    <form id="top-up-form" action="/action_page.php">
      <div class="top-up-details">

        <div class="top-up-supply">
          <p id="top-up-supply-title">Chọn nhà mạng cung cấp</p>
          <div class="top-up-supply-img">
            <label>
              <input type="radio" name="card-supply" value="vinaphone">
              <span><img src="./img/logo-vinaphone.png" alt="logo-vinaphone"></span>
            </label>

            <label>
              <input type="radio" name="card-supply" value="mobifone">
              <span><img src="./img/logo-mobifone.png" alt="logo-mobifone"></span>
            </label>

            <label>
              <input type="radio" name="card-supply" value="viettel">
              <span><img src="./img/logo-viettel.png" alt="logo-viettel"></span>
            </label>
          </div>
        </div>

        <div class="top-up-info">

          <label for="card-value">Mệnh giá thẻ</label>
          <select id="card-value" name="card-value">
            <option value="" disabled selected>Chọn mệnh giá</option>
            <option value="20.000">20.000</option>
            <option value="50.000">50.000</option>
            <option value="100.000">100.000</option>
            <option value="500.000">500.000</option>
          </select>


          <label for="card-seri">Số seri</label>
          <input type="text" id="card-seri" name="card-seri" placeholder="Nhập số seri">

          <label for="card-pin">Mã thẻ (PIN)</label>
          <input type="text" id="card-pin" name="card-pin" placeholder="Nhập mã thẻ">

          <br>
          <input type="submit" value="Xong">

          <p id="top-up-history"><a href="#">Lịch sử nạp thẻ</a></p>
        </div>

      </div>
    </form>

  </div>

</div>
@endsection