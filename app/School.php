<?php namespace Schoolprof;

use Illuminate\Database\Eloquent\Model;
use Schoolprof\Contact;

/**
 * 
 */
class School extends Model {

	//protected $primaryKey = 'brin_es'; //Disabled to make it relatable
	
	protected $fillable = [
		'parent_brin',
		'brin',
		'brin_es',
		'name',
		'denomination',
		'place',
		'street',
		'number',
		'pc',
		'municipal',
		'provence',
		'tel',
		'mail',
		'www',
		'cor_street',
		'cor_number',
		'cor_pc',
		'cor_place',
	];
	
	protected $dates = [
		'closed'
	];


	// public function notconnectedpersons()
	// {
	// 	//Fetch the id of persons already connected...
	// 	$connectedpersons = $this->contacts()->lists('person_id');
	// 	//Fetch other persons
	// 	$list = array();
	// 	foreach(Person::select('*')->whereNotIn('id',$connectedpersons)->get() as $person){
	// 		$list[$person->id] = $person->display;
	// 	}
	// 	return $list;
	// }


	

	/*-------------
		The getAttributes
	----------------*/
	public function getShowpageAttribute()
	{
		return action('SchoolsController@show',$this->brin_es);
	}

	public function getWwwAttribute($url)
	{
		if($url && trim($url) <> ""){
			return "<a href='http://$url' target='_blanc'>$url</a>";
		} else {
			return $url;
		}
	}

	public function getDisplayAttribute()
	{
		return $this->name." (".$this->place.")";
	}

	
	////////////////////
	// The relations //
	////////////////////	

	/**
	 * Returns the underlying schools in this Table.
	 * 
	 * @return \Schoolprof\School Underlying schools
	 */
	public function children()
	{
		return $this->hasMany('Schoolprof\School','parent_brin','brin_es');
	}

	/**
	 * Returns the school or schoolboard it belongs to...
	 * 
	 * @return [\Schoolprof\School] The school or schoolboard.
	 */
	public function parent()
	{
		return $this->belongsTo('Schoolprof\School','parent_brin','brin_es');
	}

	public function contacts()
	{
		return $this->morphMany('Schoolprof\Contact','relatable');
	}
	public function contactlog()
	{
		return $this->morphToMany('Schoolprof\ContactLog','relatable','contacts');
	}
}
