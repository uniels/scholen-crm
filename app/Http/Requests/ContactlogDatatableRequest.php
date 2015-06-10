<?php namespace Schoolprof\Http\Requests;

use Schoolprof\Http\Requests\Request;

class ContactlogDatatableRequest extends Request {

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
			'model' => 'sometimes|required|alpha',
			'id'	=> 'required_with:model|integer'
		];
	}

}
