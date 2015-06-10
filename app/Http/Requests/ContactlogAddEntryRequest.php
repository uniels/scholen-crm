<?php namespace Schoolprof\Http\Requests;

use Schoolprof\Http\Requests\Request;

class ContactlogAddEntryRequest extends Request {

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
			'contactdate' 	=> 'required|date_format:Y-m-d H:i:s',
			'contact_id'	=> 'required|exists:contacts,id',
			'contactdetail_id'=>'required_without:contactdetails|exists:contactdetails,id',
			'contactdetails' => 'required_without:contactdetails_id|array',
			'outbound'		=> 'required|boolean',
			'summary'		=> 'required|string|min:3|max:100',
			'agreements'	=> 'string'
		];
	}

}
