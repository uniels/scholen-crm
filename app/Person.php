<?php namespace Schoolprof;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon as Carbon;

class Person extends Model {
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = ['firstname','nickname','prefix','lastname','initials','birthday','remarks'];

	public function link($heading = null)
	{
		$heading = $heading?:$this->display;
		return "<a href='".action('PeopleController@show',$this->id)."'>$heading</a>";
	}
	
	//////////////////
	//getAttributes //
	//////////////////
	public function getDisplayAttribute()
	{
		$display = $this->firstname.' ';
		$display.= $this->prefix	? $this->prefix.' '			:'';
		$display.= $this->lastname;
		$display.= $this->nickname	? ' ['.$this->nickname.']'	:'';
		return $display;		
	}
	public function getContactdetailsAttribute()
	{
		return $this->personal->contactdetails;
	}

	/**
	 * Fill the birthday field only when the user provided a date...
	 * @param string $value The string representing the date.
	 */
	public function setBirthdayAttribute($value)
	{
		$birthday = null;
		if($value && !($value == "")){
			$birthday = Carbon::createFromFormat('Y-m-d', $value);
		}
		$this->attributes['birthday'] = $birthday;
	}



	///////////////////////
	// Pseudo-relations //
	///////////////////////

	public function relations()
	{
		return $this->contacts()->where('relatable_type','not like','%\Person')->get();
	}

	public function schoolrelations()
	{
		//Clean this up with with?? Eager load the model!
		return $this->contacts()->where('relatable_type','like','%\School')->get();
	}


	
	////////////////////
	// The relations //
	////////////////////
	
	public function contacts()
	{
		return $this->hasMany('Schoolprof\Contact','person_id');
	}

	public function personal()
	{
		return $this->morphOne('Schoolprof\Contact','relatable');
	}

	// public function schools()
	// {
	// 	return $this->morphedByMany('Schoolprof\School','relatable','contacts');
	// }

	
}
