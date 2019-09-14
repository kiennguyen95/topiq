<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

  public function home()
  {
    return view('pages.home');
  }

  public function profile()
  {
    $user = [
      'avatar_src' => 'abc',
      'name' => 'oOoProVipOoo',
      'balance' => '10.000.000',
      'games' => [
        [
          'name' => 'TOPIQ',
          'icon_src' => '/img/game.png',
          'icon_alt' => 'topiq',
          'rank' => '1',
          'elo' => '1234',
          'won' => '123',
          'lost' => '12',
          'draw' => '1',
          'medal_gold' => '12',
          'medal_silver' => '8',
          'medal_bronze' => '4',
        ],
        [
          'name' => 'CỜ CARO',
          'icon_src' => '/img/game.png',
          'icon_alt' => 'ca-ro',
          'rank' => '2',
          'elo' => '43345',
          'won' => '53',
          'lost' => '122',
          'draw' => '11',
          'medal_gold' => '122',
          'medal_silver' => '8',
          'medal_bronze' => '4',
        ],
        [
          'name' => 'ĐA SỐ THIỂU SỐ',
          'icon_src' => '/img/game.png',
          'icon_alt' => 'da-so-thieu-so',
          'rank' => '3',
          'elo' => '6236',
          'won' => '4',
          'lost' => '4',
          'draw' => '0',
          'medal_gold' => '17',
          'medal_silver' => '55',
          'medal_bronze' => '47',
        ],
      ]
    ];

    $user = json_decode(json_encode($user));
//    dump($user); die;
    return view('pages.profile')->with('user', $user);
  }

  public function resetPassword()
  {
    return view('pages.reset_password');
  }
}
