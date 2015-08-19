<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string( 'firstname' ,100);
            $table->string( 'nickname'  ,100)->nullable();
            $table->string( 'prefix'    ,15 )->nullable();
            $table->string( 'lastname'  ,100);
            $table->string( 'initials'  ,15 )->nullable();
            $table->date(   'birthday'      )->nullable();
            $table->longtext('remarks'      )->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('people');
    }
}
