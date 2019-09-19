<?php

namespace App\Http\Controllers;

use App\Services\CommonService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PageController extends Controller
{

  public function home()
  {
    $games = [
      [
        'name' => 'Đấu trường quái vật',
        'icon_src' => '/img/game.png',
        'icon_alt' => 'topiq',
        'description' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p><p>a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem</p>",
      ],
      [
        'name' => 'Đấu trường vật',
        'icon_src' => '/img/game.png',
        'icon_alt' => 'topiq',
        'description' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p><p>a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem</p>",
      ],
      [
        'name' => 'Đấu quái vật',
        'icon_src' => '/img/game.png',
        'icon_alt' => 'topiq',
        'description' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p><p>a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem</p>",
      ],
      [
        'name' => 'Trường quái vật',
        'icon_src' => '/img/game.png',
        'icon_alt' => 'topiq',
        'description' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p><p>a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem</p>",
      ],
    ];
    return view('pages.home')->with('games', $games);
  }

  public function profile($uid)
  {
    $client = new Client();
    $headers = [
    'Iat' => '1547697761113',
    'Checksum' => '55644f801e1a9e4021a27c23e685eea1f1192fc832f62a5e014b5ce5d0396600',
    'User-Agent' => 'TTTP_dev',
    'Uuid' => '36aa4e3c7f9eeb5d',
    'Version' => '1.6.0',
    ];
    $query = [
      'player_id' => $uid,
    ];
    $options = [
      'headers' => $headers,
      'query' => $query,
    ];
    $response = $client->request('GET', 'http://truytimtrieuphu.com/apiv9/users/get-profile', $options);
    $result = json_decode($response->getBody()->getContents(), TRUE);

    if (!$result['status']) {
      return abort(404);
    }

    $data = $result['data'];
    $user = [
      'avatar_src' => $data['playerInfor']['avatar'],
      'name' => $data['playerInfor']['nickname'],
      'balance' => '10.000.000',
    ];
    $games = [];
    foreach ($data['gameStatistics'] as $game_data) {
      $games[] = [
        'name' => $game_data['gameName'],
        'icon_src' => '/img/game.png',
        'icon_alt' => $game_data['gameName'],
        'rank' => $game_data['rank'],
        'elo' => $game_data['points'],
        'won' => isset($game_data['totalMatchesWon']) ? $game_data['totalMatchesWon'] : NULL,
        'lost' => isset($game_data['totalMatchesLost']) ? $game_data['totalMatchesLost'] : NULL,
        'draw' => isset($game_data['totalMatchesDraw']) ? $game_data['totalMatchesDraw'] : NULL,
        'medal_gold' => isset($game_data['goldmedals']) ? $game_data['goldmedals'] : 0,
        'medal_silver' => isset($game_data['silvermedals']) ? $game_data['silvermedals'] : 0,
        'medal_bronze' => isset($game_data['bronzemedals']) ? $game_data['bronzemedals'] : 0,
        ];
    }
    $user['games'] = $games;

    return view('pages.profile')->with('user', $user);
  }

  public function resetPassword($token)
  {
    return view('pages.reset_password');
  }

  public function changePassword()
  {
    return view('pages.reset_password');
  }

  public function verifyEmail($id, $token)
  {
    $service = new CommonService();
    $state = $service->verifyEmail($id, $token);
    dump($state);
    switch ($state) {
      case NULL:
        $message = \Config::get('message.verify_email.failed');
        break;
      case 0:
        $message = \Config::get('message.verify_email.success');
        break;
      case 1:
        $message = \Config::get('message.verify_email.already_verified');
        break;
    }
    dump($message); die;
    return view('pages.verify_email')->with('message', $message);
  }
}
