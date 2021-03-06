<?php namespace Schoolprof;

use Illuminate\Database\Eloquent\Model;

class ContactLog extends Model {

	//protected $attributes = ['user_id' => \Auth::user()->id];
	protected $casts = ['outbound' => 'boolean'];
	protected $dates = ['contactdate'];
	protected $fillable = [
		'contactdate',
		'contact_id',
		'contactdetail_id',
		'outbound',
		'summary',
		'agreements',
	];

	////////////////
	//Relations: //
	////////////////

	public function user()
	{
		return $this->belongsTo('Schoolprof\User');
	}

	public function contact()
	{
		return $this->belongsTo('Schoolprof\Contact');
	}

	public function medium()
	{
	  return $this->belongsTo('Schoolprof\Contactdetail');
	}

}
