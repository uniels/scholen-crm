<?php namespace Schoolprof\Http\Controllers;

use Schoolprof\Http\Requests;
use Schoolprof\Http\Controllers\Controller;
use Auth;
use Request;

class PublicController extends Controller {

	/**
	 * Display the default front-page.
	 *
	 * @return view
	 */
	public function login()
	{
		if( !Auth::user()){
			return view('public.login');
		}
		return redirect('start');
	}

	/**
	 * Authenticate the user. 
	 * On succes go to intended page. 
	 * On failure: continue.
	 * 
	 * @return view
	 */
	public function authenticate()
	{
        if (Auth::attempt(Request::only('username', 'password')))
        {
            flash()->success(trans('template.loginsuccess'));
            return redirect()->intended('start');
        }
        // Failure...
        flash()->error(trans('template.loginfailure'));
        return redirect()->back()->withInput();
	}

	/**
	 * Logout the user.
	 * Send him to a 'goodbye'-page
	 */
	public function logout()
	{
		if(Auth::user()){
			$name = Auth::user()->displayname;
			Auth::logout();
            flash()->success(trans('template.logoutsuccess',compact('name')));
		} 
		return redirect('login');


	}

	
}
