<?php namespace Schoolprof\Http\Controllers;

use Schoolprof\Http\Requests\XlsUploadRequest;
use Schoolprof\Http\Requests\ContactbasicRequest;
use Schoolprof\Http\Controllers\Controller;
use Schoolprof\Imports\SchoolsImport;
use Schoolprof\School;
use Schoolprof\Person;
use Schoolprof\Contact;
use Schoolprof\ContactLog;

use Datatables;

use Illuminate\Http\Request;


class SchoolsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$school = new School;
		return view('schools.index',compact('school'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('schools.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SchoolsImport $schools)
	{
		if( $schools->import() ){
			flash()->success( $schools->report() );
			return redirect('schools');
		} else {
			flash()->error( $schools->report() );
			return \Redirect::back();
		}
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function show(School $school)
	{
		return view('schools.show',compact('school'));
	}

	/**
	 * Lists all schools with specific brin.
	 * @param  string $brin The brin provided
	 * @return view       The view with all the schools...
	 */
	public function getList(School $school)
	{
		return view('schools.list',compact('school'));
	}

	/**
	 * Stream for TableData
	 * @param  Request $request Get additional data
	 * @return DataTables           The stream.
	 */
	public function getData(Request $request)
	{
	    //https://github.com/yajra/laravel-datatables-oracle#example-view-and-controller
	    $schools = School::select('*');
	    $brinlimit = $request->input('brinlimit','');
	    if($brinlimit && !($brinlimit == '' ) ){
	    	$schools->where('brin','=',$brinlimit)->orWhere('parent_brin','=',$brinlimit);
	    }
	    return Datatables::of($schools)
	        ->addColumn('actions', 'action here')
	        ->editColumn('name','<a href="{{ route("schools.show", ["id" => $brin_es]) }}">{{ $name }}</a>')
	        ->make(true);	
	}

	public function getContactlog(School $school)
	{
		$contactsID = $school->contacts()->lists('id');
		$contactlog = ContactLog::whereIn('contact_id',$contactsID)->get();		

		return view('schools.contactlog',compact('school','contactlog'));
	}

	public function addContact(ContactbasicRequest $request,School $school)
	{
		$contact = $school->contacts()->save(new Contact($request->all()));

		return redirect()->route('contacts.show',$contact);
	}

	public function getPersons(School $school,Request $request)
	{
		$this->validate($request,[
			'searchquery' => 'required|string|max:100'
			]);
		$searchquery = $request->input('searchquery');
		$keys = explode(" ",trim($searchquery));

		//To exclude:
		$connectedpersons = $school->contacts()->lists('person_id');
		$persons = Person::select(\DB::raw('id, concat( firstname," ",prefix," ",lastname," (",nickname,")" ) as text'))->whereNotIn('id',$connectedpersons);

        foreach($keys as $key){
        	$persons->where(function($query) use ($key)
        	{
        		$search = "%$key%";
        		$query	->orWhere(	'firstname'	,'LIKE',$search)
			            ->orWhere(	'lastname'	,'LIKE',$search)
			            ->orWhere(	'nickname'	,'LIKE',$search);
        	});
        }
        $persons->take(7);

		return json_encode($persons->get());
	}

}
