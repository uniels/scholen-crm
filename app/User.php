<?php namespace Schoolprof;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class User extends Model implements AuthenticatableContract {

	use Authenticatable;
	use SoftDeletes; //Not harddelete them! We need them for the contactlog.

	protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['displayname','username', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password','remember_token'];


	public function setPasswordAttribute($password)
	{
		if($password && strlen($password) > 5 ){
			$this->attributes['password'] = \Hash::make($password);
		}
	}

	/**
	 * Set username to lowercase
	 */
	public function setUsernameAttribute($username)
	{
		$this->attributes['username'] = strtolower($username);
	}

	public function link()
	{
		return "<a href='".action('UsersController@show',$this->id)."'>".$this->displayname."</a>";
	}


	//Relations:
	public function contactLog()
	{
		return $this->hasMany('Schoolprof\ContactLog');
	}


}
