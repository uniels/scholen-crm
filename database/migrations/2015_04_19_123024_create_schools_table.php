<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->string('parent_brin',10);

            $table->string('brin',10);
            $table->string('brin_es',10); // brin = brin_es ? schoolboard : school. 

            $table->string('name',50);
            $table->string('denomination',50);

            $table->string('place',50);
            $table->string('street',50);
            $table->string('number',10);
            $table->string('pc',10);
            $table->string('municipal',50);
            $table->string('provence',50)->nullable(); //Not available in boards-file

            $table->string('tel',15)->nullable();
            $table->string('mail',64)->nullable(); //Not available in both files??
            $table->string('www',64)->nullable();

            $table->string('cor_street',50);
            $table->string('cor_number',10);
            $table->string('cor_pc',10);
            $table->string('cor_place',50);
            //Not needed at the moment...
            // $table->integer('nodal_id')->nullable();
            // $table->integer('rpa_id')->nullable();
            // $table->integer('wgr_id')->nullable();
            // $table->integer('corop_id')->nullable();
            // $table->integer('education_id')->nullable();
            // $table->integer('rmc_id')->nullable();
            $table->date('closed')->nullable()->default(null);

            //Adding indexes
            $table->index('brin');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schools');
    }

}
