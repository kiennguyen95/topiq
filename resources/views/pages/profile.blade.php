@extends('layouts.master')

@section('style')
  @parent
  <link rel="stylesheet" type="text/css" href="/css/profile.css">
@endsection
@section('content')
  <div class="profile-wrapper">
    <div class="user-info">
      <div class="avatar"><img src="{{ $user->avatar_src }}" alt=""></div>
      <div class="name">{{ $user->name }}</div>
      <div class="account-balance">
        <div class="value">{{ $user->balance }} VNĐ</div>
        <div class="label">Số tiền chiến thắng</div>
      </div>
    </div>

    <div class="games-statistics owl-carousel">
      @foreach ($user->games as $game)
        <div class="game-achievements">
          <div class="game-icon"><img src="{{ $game->icon_src }}" alt="{{ $game->icon_alt }}"></div>
          <div class="info">
            <ul>
              <li>
                <span>{{ $game->name }}</span>
                <span>Hạng {{ $game->rank }}</span>
              </li>
              <li>
                <span>Elo</span>
                <span>{{ $game->elo }}</span>
              </li>
              <li>
                <span>Thắng</span>
                <span>{{ $game->won }}</span>
              </li>
              <li>
                <span>Thua</span>
                <span>{{ $game->lost }}</span>
              </li>
              <li>
                <span>Hòa</span>
                <span>{{ $game->draw }}</span>
              </li>
            </ul>
            <ul class="medal-list">
              <li class="medal-gold">
                <span>{{ $game->medal_gold }}</span>
              </li>
              <li class="medal-silver">
                <span>{{ $game->medal_silver }}</span>
              </li>
              <li class="medal-bronze">
                <span>{{ $game->medal_bronze }}</span>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
@section('script')
  @parent
  <script src="/js/owl.carousel.min.js"></script>
  <script src="/js/profile.js"></script>
@endsection