<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('staff_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staff_id',30)->unique();
            $table->string('surname',30);
            $table->string('other_name',30);
            $table->string('gender',1);
            $table->date('date_of_birth');
            $table->string('contact_no');
            $table->string('email', 60);
            $table->string('postal_address',60);
            $table->string('residential_address',60);
            $table->string('ssn',30)->unique();
            $table->string('nok_name',60);
            $table->string('nok_contact',20);
            $table->string('nok_address',60);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->integer('approved_by')->unsigned();
            $table->boolean('status');
            $table->string('ref_code',8);
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staff_info');
    }
}
