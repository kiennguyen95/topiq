<?php

namespace App\Http\Controllers;

use App\Exceptions\DatabaseException;
use App\Services\DataService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
  /**
   * The data service implementation.
   *
   * @var DataService
   */
  protected $service;

  /**
   * Create a new controller instance.
   *
   * @param  DataService  $users
   * @return void
   */
  public function __construct(DataService $service)
  {
    $this->service = $service;
  }

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
    try {
      $verified = $this->service->verifyToken($token);
    } catch (DatabaseException $exception) {
      throw $exception;
    }
    if (!$verified)
    {
      return view('pages.notice')->with('message', config('message.system.page_not_found'));
    }
    return view('pages.reset_password')->with('token', $token);
  }

  public function changePassword(Request $request, $token)
  {
    try {
      $verified = $this->service->verifyToken($token);
      if (!$verified)
      {
        return view('pages.notice')->with('message', config('message.system.page_not_found'));
      }
      $request->get('password');
      $validator = Validator::make($request->all(), [
        'password' => 'required|min:3',
        'confirm_password' => 'required|same:password',
      ]);

      if ($validator->fails()) {
        return view('pages.notice')->with('message', config('message.system.invalid_data'));
      }
      $this->service->updatePassword($token, $request->get('password'));
    }
    catch (DatabaseException $exception) {
      throw $exception;
    }
    return view('pages.notice')->with('message', config('message.change_password.success'));
  }

  public function verifyEmail($id, $token)
  {
    try {
      $state = $this->service->verifyEmail($id, $token);
    } catch (DatabaseException $exception) {
      throw $exception;
    }

    switch ($state) {
      case -1:
        $message = config('message.system.page_not_found');
        break;
      case 0:
        $message = config('message.verify_email.success');
        break;
      case 1:
        $message = config('message.verify_email.already_verified');
        break;
    }
    return view('pages.notice')->with('message', $message);
  }

  public function topUp()
  {
    return view('pages.top_up');
  }

  public function paymentHistory()
  {
    return view('pages.payment_history');
  }
}
