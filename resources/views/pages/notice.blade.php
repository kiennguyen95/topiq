@extends('layouts.master')

@section('style')
  @parent
  <link rel="stylesheet" type="text/css" href="/css/notice.css">
@endsection

@section('content')
  <div class="notice-wrapper">
    <div class="notice-content">
      <img id="notice-img" src="/img/notice-icon.svg" alt="notice-icon">
      <p id="notice-msg">{{ $message }}</p>
    </div>
  </div>
@endsection
