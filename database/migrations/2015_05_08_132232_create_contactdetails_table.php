<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactdetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contactdetails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('type', 10);	
			$table->string('value',200);

			//
		});

		DB::table('contactdetails')->insert([
			['type' => 'f2f', 'value' => ' ']
			]);

		Schema::create('contact_contactdetail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('contact_id')->unsigned();
			$table->integer('contactdetail_id')->unsigned();		
			$table->string('label',200);
			//
			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
			$table->foreign('contactdetail_id')->references('id')->on('contactdetails')->onDelete('cascade');


		});



	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contact_contactdetail');
		Schema::drop('contactdetails');
	}

}
