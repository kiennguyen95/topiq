@extends('layouts.master')

@section('style')
  @parent
  <link rel="stylesheet" type="text/css" href="/css/lib/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="/css/home.css">
@endsection
@section('content')
  <div class="home-wrapper">
    <div class="home-banner"></div>
    <div class="home-page-games owl-carousel owl-theme">
      @foreach ($games as $game)
        <div class="game-item">
          <div class="home-game-icon"><img src="{{ $game['icon_src'] }}" alt="{{ $game['icon_alt'] }}"></div>
          <div class="home-game-info">
            <div class="home-game-name">
              {{ $game['name'] }}
            </div>
            <div class="home-game-description">
              {!! html_entity_decode($game['description']) !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
@section('script')
  @parent
  <script src="/js/lib/owl.carousel.min.js"></script>
  <script src="/js/home.js"></script>
@endsection