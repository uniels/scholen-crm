<?php namespace Schoolprof;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contactdetail extends Model {
  use SoftDeletes;

  protected $dates 		= ['deleted_at'];
  protected $fillable 	= ['contact_id','type','label','value'];

  
  

  ///////////////////
  // The relations //
  ///////////////////
  public function contact()
  {
  	return $this->belongsToMany('Schoolprof\Contact')->withPivot('label');
  }

  public function log()
  {
  	return $this->hasMany('Schoolprof\ContactLog');
  }
  



}
