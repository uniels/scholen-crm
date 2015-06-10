<?php namespace Schoolprof\Http\Requests;

use Schoolprof\Http\Requests\Request;

class PeopleRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
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
			'firstname'		=> 'required|string|min:3|max:100',
			'nickname'		=> 'string|max:100',
			'prefix'		=> 'string|max:15',
			'lastname'		=> 'required|string|min:3|max:100',
			'initials'		=> 'string|max:15',
			'birthday'		=> 'date',
			'details' 		=> 'array',
			'remarks'		=> 'string'

		];
	}

}
