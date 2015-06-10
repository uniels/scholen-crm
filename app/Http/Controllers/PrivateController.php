<?php namespace Schoolprof\Http\Controllers;

use Schoolprof\Http\Requests;
use Schoolprof\Http\Controllers\Controller;
use Auth;

use Illuminate\Http\Request;

class PrivateController extends Controller {

	/**
	 * Sets up the startpage.
	 */
	public function start()
	{
		$user = Auth::user();
		return view('private.start',['displayname' => $user->displayname]);
	}

}
