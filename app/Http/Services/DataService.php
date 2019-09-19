<?php

namespace App\Services;

use App\Exceptions\DatabaseException;
use Illuminate\Support\Facades\DB;

/**
 * Class CommonService
 *
 * @package App\Services
 */
class DataService
{

  /**
   * Verify player by token
   *
   * @param $token
   *
   * @return bool
   */
  public function verifyToken($token)
  {
    $player = DB::table('players')->where('token', $token)->first();
    if (empty($player)) return FALSE;
    return TRUE;
  }

  /**
   * Update password for player account by token
   *
   * @param $token
   * @param $password
   *
   * @return int
   */
  public function updatePassword($token, $password)
  {
    return DB::table('players')->where('token', $token)->update(['password' => $password]);
  }

  /**
   * Verify email for player
   *
   * @param $id
   * @param $token
   *
   * @return int
   * @throws DatabaseException
   */
  public function verifyEmail($id, $token)
  {
    try {
      $player = DB::table('players')
        ->where([
          'id' => $id,
          'token' => $token,
        ])
        ->first();
      if (empty($player)) {
        return -1;
      }
      if (!$player->verified) {
        DB::table('players')->where('token', $token)->update(['verified' => 1]);
      }
      return $player->verified;
    } catch (\Exception $e) {
      throw new DatabaseException();
    }
  }
}
