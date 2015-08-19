<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_logs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('contactdate');
            $table->integer('user_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->integer('contactdetail_id')->unsigned();
            $table->boolean('outbound'); //Did the user contacted the contactperson (or otherwise)?
            $table->string('summary',200);
            $table->longText('agreements')->nullable();

            //The foreign keys:
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('contactdetail_id')->references('id')->on('contactdetails');

            //The indexes:
            $table->index('user_id');
            $table->index('contact_id');
            $table->index('contactdetail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contact_logs');
    }

}
