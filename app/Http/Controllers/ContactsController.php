<?php namespace Schoolprof\Http\Controllers;

use Schoolprof\Http\Requests;
use Schoolprof\Http\Requests\ContacteditRequest;
use Schoolprof\Http\Requests\ContactbasicRequest;
use Schoolprof\Http\Controllers\Controller;

use Schoolprof\Contact;

use Illuminate\Http\Request;

class ContactsController extends Controller {


	/**
	 * Store a newly created resource in storage.
	 * @param  ContactbasicRequest $request UserInput
	 * @return view                   		Previous page    
	 */
	public function store(ContactbasicRequest $request)
	{

		$contact = Contact::create($request->all());

		//Finally: save personal contactdetails:
		$contactdetails = $request->only('contactdetails');
		$result = (new ContactdetailsController)->process($contact,$contactdetails);

		flash()->success(trans('template.storesuccess'));
		return \Redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Contact $contact)
	{
		return view('contacts.show',compact('contact'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param  Contact $contact The contactperson
	 * @return view 
	 */
	public function edit(Contact $contact)
	{
		return view('contacts.edit',compact('contact'));
	}	

	/**
	 * Update the specified resource in storage.
	 * 
	 * @param  ContacteditRequest $request Userinput
	 * @param  Contact            $contact 
	 * @return view               
	 */
	public function update(ContacteditRequest $request,Contact $contact)
	{
		$update = $contact->update($request->except('contactdetails'));
		//And the contactdetails:
		$contactdetails = $request->only('contactdetails');		
		$result = (new ContactdetailsController)->process($contact,$contactdetails);
		
		if($update & $result) {
		  flash()->success(trans('template.updatesuccess'));
		} else {
		  flash()->error(trans('template.error'));
		}
		
		return redirect()->route('contacts.show',$contact);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  Contact $contact 
	 * @return view           Previous page
	 */
	public function destroy(Contact $contact)
	{
		$contact->delete();
		flash()->success(trans('template.deletesuccess'));
		return \Redirect::back();		
	}


	//JSON:
	/**
	 * Accept a searchquery from a select2-selectbox
	 * Looks into the database for matching patterns.
	 * The result should have the format like: [{"id":"id","text":<label>}]
	 * @param  Request 	$request 	The searchquery
	 * @return Json           		The searchresult, with a max of 7 results.
	 */
	public function getNames(Request $request)
	{
		$this->validate($request,[
			'searchquery' => 'required|string|max:100'
			]);
		$searchquery = $request->input('searchquery');
		$keys = explode(" ",trim($searchquery));

		/*
		 * SELECT ['contact.id person.firstname person.prefix person.lastname person.nickname contact.function']
		 * 	FROM contacts 
		 * 	JOIN people 	ON person.id 		= person_id
		 * 	JOIN schools	ON schools.brin_es 	= school_brin
		 * 	--for every $searchquery-part as key--
		 * 		WHERE [person.firstname or person.lastname or person.nickname or person.nickname or contacts.function or schools.name] LIKE %key% 
		 * 	--
		 * 	LIMIT 7
		 */

		$contacts = \DB::table('contacts')
            ->join('people', 'contacts.person_id', '=', 'people.id')
            ->join('schools', 'contacts.school_brin','=','schools.brin_es')        
            ->select(\DB::raw('contacts.id as id, concat( people.firstname," ",people.prefix," ",people.lastname," (",people.nickname,") | ",schools.name," (",contacts.function,")" ) as text'));
        foreach($keys as $key){
        	
        	$contacts->where(function($query) use ($key)
        	{
        		$search = "%$key%";
        		$query	->orWhere(	'people.firstname'	,'LIKE',$search)
			            ->orWhere(	'people.lastname'	,'LIKE',$search)
			            ->orWhere(	'people.nickname'	,'LIKE',$search)
			            ->orWhere(	'contacts.function'	,'LIKE',$search)
			            ->orWhere(	'schools.name'		,'LIKE',$search);
        	});
        }
        $contacts->take(7);
		return json_encode($contacts->get());
	}

}
