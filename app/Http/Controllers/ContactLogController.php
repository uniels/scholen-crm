<?php namespace Schoolprof\Http\Controllers;

//use Schoolprof\Http\Requests;
use Schoolprof\Http\Requests\ContactlogAddEntryRequest;
use Schoolprof\Http\Requests\ContactlogDatatableRequest;
use Schoolprof\Http\Requests\ContactlogEditRequest;
use Schoolprof\Http\Controllers\Controller;
#
use Schoolprof\Contact;
use Schoolprof\ContactLog;
use Schoolprof\Person;
use Schoolprof\School;
use Schoolprof\User;
use Datatables;


use Illuminate\Http\Request;

class ContactLogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('contactlog.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('contactlog.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ContactlogAddEntryRequest $request)
	{
		$values = $request->all();
		//If the user attached new contactdetails, 
		//we have to store them first and request an id.
		if(array_key_exists('contactdetails',$values)){
			$newcontactdetails = $values['contactdetails'];
			//(new ContactdetailsController)->processOne($contact,$contactdetails);
			$contact = Contact::findOrFail($values['contact_id']);
			$id = (new ContactdetailsController)->processOne($contact,$newcontactdetails);
			$values['contactdetail_id'] = $id;
			unset($values['contactdetails']);
		}
		$contactlog = new ContactLog($values);
		\Auth::user()->contactLog()->save($contactlog);
		flash()->success(trans('template.storesuccess'));
		return redirect()->back();
		// return redirect()->route('contactlog.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  ContactLog  $contactlog
	 * @return Response
	 */
	public function show(ContactLog $contactlog)
	{
		return view('contactlog.show',compact('contactlog'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  ContactLog  $contactlog
	 * @return Response
	 */
	public function edit(ContactLog $contactlog)
	{
		return view('contactlog.edit',compact('contactlog'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  ContactLog  $contactlog
	 * @return Response
	 */
	public function update(ContactLog $contactlog,ContactlogEditRequest $request)
	{
		$contactlog->update($request->all());
		flash()->success(trans('template.updatesuccess'));
		return  redirect()->route('contactlog.show',$contactlog);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  ContactLog  $contactlog
	 * @return Response
	 * /
	public function destroy(ContactLog $contactlog)
	{
		//
	}
	*/


	/**
	 * Stream for TableData: it accepts JSON request from the datatable 
	 * and it returns the requested data to display it in the datatable
	 * 
	 * @param  Request 		$request 	Request of specific data
	 * @return DataTables           	The requested data
	 */
	public function getData(ContactlogDatatableRequest $request)
	{
	    //https://github.com/yajra/laravel-datatables-oracle#example-view-and-controller
	    $contactlogs = ContactLog::select(['id','contactdate','outbound','summary','user_id','contact_id']);
	    $data = $request->all();
	    if(isset($data['model'])){
	    	switch($data['model']){
	    		case 'school':
	    			$school = School::findOrFail($data['id']);
	    			$contactsID = $school->contacts()->lists('id');
	    			$contactlogs->whereIn('contact_id',$contactsID);
	    			break;
	    		case 'contact':
	    			$contactlogs->where('contact_id',$data['id']);
	    			break;
	    		case 'user':
	    			$contactlogs->where('user_id',$data['id']);
	    			break;
	    		case 'person':
	    			$person = Person::findOrFail($data['id']);
	    			$contactsID = $person->contacts()->lists('id');
	    			$contactlogs->whereIn('contact_id',$contactsID);
	    			break;	    			
	    	}
	    }
	    $contactlogs->orderBy('contactdate', 'desc');

	    return Datatables::of($contactlogs)
	        ->editColumn('contactdate',function($contactlog){
	        	//return setlocale(LC_TIME,'nl_NL');
	        	//return $contactlog->contactdate->formatLocalized("%A %d %B %Y");
	        	return $contactlog->contactdate->format('d/m/Y H:i');
	        })
	        ->editcolumn(
	        	'outbound',
	        	'<span class=\'glyphicon glyphicon-chevron-{{$outbound?"right":"left"}}\'></span>'
	        	)
	        ->editColumn('summary','<a href="{{ route("contactlog.show", ["id" => $id]) }}">{{ $summary }}</a>')
	        ->addColumn('user',function ($contactlog) {
                return $contactlog->user->link();
            })
	        ->addColumn('contact',function($contactlog){
	        	return $contactlog->contact->link();
	        })
	        ->make(true);	
	}
}
