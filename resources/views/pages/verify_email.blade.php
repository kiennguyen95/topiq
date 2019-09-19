@extends('layouts.master')

@section('style')
@parent
<link rel="stylesheet" type="text/css" href="/css/verify_email.css">
@endsection
@section('content')
<div class="verify-wrapper">
  <div class="verify-content">
    <img id="verify-img" src="./img/group-4.svg" alt="group-4">
    <p id="verify-msg">{{ $message }}</p>
  </div>
</div>
@endsection
