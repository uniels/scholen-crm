<?php namespace Schoolprof;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model {
	use SoftDeletes; //Not harddelete them! We need them for the contactlog.

	protected $casts = ['contactdetails' => 'array'];
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'person_id',
		'function',
		'remarks'
	];
	

	// //Links
	// public function link($heading = null)
	// {
	// 	$heading = $heading?:$this->display;
	// 	return "<a href='".action('ContactsController@show',$this->id)."'>$heading</a>";
	// }
	// public function linkedit($heading = null)
	// {
	// 	$heading = $heading?:trans('template.edit');
	// 	return "<a href='".action('ContactsController@edit',$this->id)."'>$heading</a>";
	// }
	// public function linkdestroy($heading = null)
	// {
	// 	$heading = $heading?:trans('template.remove');
	// 	$link = \Form::open(array('route' => array('contacts.destroy', $this->id), 'method' => 'delete'));
	// 	$link.= '<button type="submit" class="btn btn-danger btn-xs">'.$heading.'</button>';
	// 	$link.= \Form::close();

	// 	return $link;	
	// }

	// GetAttributes
	public function getDisplayAttribute()
	{
		return $this->person->display.' ('.$this->function.')';
	}

	public function getTypeAttribute()
	{
		$relatable = explode('\\',$this->relatable_type);
		return trans('contacts.'.strtolower(end($relatable)));
	}

	//SetAttributes
	public function setContactdetailsAttribute($value)
	{
		var_dump($value);	
	}

	/**
	 * Provides a clean list of all the contactdetails.
	 * @return array List.
	 */
	public function exportContactdetails()
	{
	  $list = [];
	  if( is_array($this->contactdetails)){
		foreach($this->contactdetails as $type => $details){
		  foreach($details as $name => $values){
		  	$label = trans('contactdetails.'.$type)." (".$name.")";
		  	foreach($values as $value){
		  	  $list[] = $label.": ".$value;
		  	}
		  }
		}
	  }
	  return $list;
	}

	
	////////////////////
	// The relations //
	////////////////////
	
	public function relation()
	{
		return $this->morphTo('relatable');
	}

	public function person()
	{
		return $this->belongsTo('Schoolprof\Person');
	}
	
	public function contactLog()
	{
		return $this->morphMany('Schoolprof\ContactLog','approachable');
	}

	public function contactdetails()
	{
		return $this->belongsToMany('Schoolprof\Contactdetail')->withPivot('label');
	}

}
