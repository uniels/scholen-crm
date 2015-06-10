<?php namespace Schoolprof\Http\Controllers;

use Schoolprof\Http\Requests;
use Schoolprof\Http\Requests\UserRequest;
use Schoolprof\Http\Controllers\Controller;
use Schoolprof\User;

use Illuminate\Http\Request;


class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::withTrashed()->get();

		return view('users.index',compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		$this->validate($request,[
			'username'		=> "alpha_num|required|between:3,60",
			'displayname'	=> 'string|required|between:3,60',
			'password'		=> 'string|between:5,60'
			]);
		User::create($request->all());
		flash()->success(trans('template.storesuccess'));
		return redirect('users');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::withTrashed()->findOrFail($id);
		return view('users.show',compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$user = User::withTrashed()->findOrFail($id);
		return view('users.edit',compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		//
		$user = User::withTrashed()->findOrFail($id);
		$this->validate($request,[
			'displayname'	=> 'string|required|between:3,60',
			'password'		=> 'between:5,60'
			]);
		$user->update($request->all());
		flash()->success(trans('template.updatesuccess'));
		return view('users.show',compact('user'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//user may not delete themself!
		if($id == \Auth::user()->id){
			flash()->error(trans('users.dontdeleteyourself'));
		} else {
			$user = User::withTrashed()->findOrFail($id);
			if($user->deleted_at){
				//User is already deleted: restore!
				$user->restore();
				flash()->success(trans('users.userrestored'));
			} else {
				$user->delete();
				flash()->info(trans('users.usersoftdeleted'));
			}
		}
		return redirect('users');
	}

}
