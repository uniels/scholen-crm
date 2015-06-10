<?php namespace Schoolprof\Http\Requests;

use Schoolprof\Http\Requests\Request;


class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		//What about authorization? :-s
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
			'username'		=> "alpha_num|required|between:3,60",		
			'displayname'	=> 'string|required|between:3,60',
			'password'		=> 'between:5,60'
		];
	}

}
