<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Schoolprof\User;


class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username',60)->unique();
			$table->string('password',126);
			$table->string('displayname',60);
			$table->softDeletes(); //Not harddelete them! We need them for the contactlog.
			$table->rememberToken();
			$table->timestamps();
		});
		User::create([
			'username' 		=> 'firstuser',
			'displayname'	=> 'John Doe',
			'password'		=> 'changeme'
			]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
