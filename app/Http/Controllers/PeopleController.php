<?php namespace Schoolprof\Http\Controllers;

use Schoolprof\Http\Requests;
use Schoolprof\Http\Requests\PeopleRequest;
use Schoolprof\Http\Controllers\Controller;
use Schoolprof\Http\Controllers\ContactdetailsController;

//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Schoolprof\Person;
use Schoolprof\Contact;
use Schoolprof\Contactdetail;

use Datatables;

class PeopleController extends Controller {

    //use SoftDeletes;

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$people = Person::get(['id','firstname','prefix','lastname','nickname']);
		return view('people.index',compact('people'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('people.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PeopleRequest $request)
	{
		//First make the person.
		$person = Person::create($request->except('contactdetails'));
		// When we make a person for the first time, 
		// we assign them a private-contact too,
		// to store the personalcontactdetails.
		$personalcontact = New Contact(	['person_id' => $person->id,'function' => 'Personal']);
		$personalcontact = $person->personal()->save($personalcontact);

		//Finally: save personal contactdetails:
		$contactdetails = $request->only('contactdetails');
		$result = (new ContactdetailsController)->process($personalcontact,$contactdetails);
		flash()->success(trans('template.storesuccess'));
		return  redirect()->route('people.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Person $person)
	{
		$person->load('contacts','personal');
		return view('people.show',compact('person'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Person $person)
	{
		return view('people.edit',compact('person'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PeopleRequest $request,Person $person)
	{
		$update = $person->update($request->except('contactdetails'));
		$contactdetails = $request->only('contactdetails');
		$result = (new ContactdetailsController)->process($person->personal,$contactdetails);
		flash()->success(trans('template.updatesuccess'));
		return redirect()->route('people.show',['people' => $person->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Person $person)
	{
		$name = $person->display();
		$person->delete();
		flash()->success(trans('people.destroyed',compact('name')));
		return $this->index();
	}

	/**
	 * Stream for TableData
	 * @return DataTables           The stream.
	 */
	public function getData()
	{
	    //https://github.com/yajra/laravel-datatables-oracle#example-view-and-controller
	    $people = Person::select('*');
	    return Datatables::of($people)
	        ->editColumn('firstname','<a href="{{ route("people.show", ["id" => $id]) }}">{{ $firstname }}</a>')
	        ->make(true);	
	}
}
