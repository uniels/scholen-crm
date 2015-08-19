<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('person_id')->unsigned();
            $table->morphs('relatable');
            $table->string('function',100);
            $table->text('remarks')->nullable();
            $table->softDeletes(); //Not harddelete them! We need them for the contactlog.

            //Foreign keys
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');

        });

        // Schema::table('contacts', function($table)
        // {

        // });      


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('contacts', function($table){
        //     $table->dropForeign('contacts_person_id_foreign');
        // });

        
        Schema::drop('contacts');
    }

}
