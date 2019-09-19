<?php

namespace App\Exceptions;

use Exception;

class DatabaseException extends Exception
{
  /**
   * Report or log an exception.
   *
   * @return void
   */
  public function report()
  {
    \Log::debug('Database connection failed.');
  }

  public function render($request)
  {
    return view('pages.notice')->with('message', config('message.system.maintenance'));
  }
}
