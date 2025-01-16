<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->date('employment_date');
            $table->string('employee_name', 255);
            $table->string('nick_name', 255);
            $table->string('employee_designation', 255);
            $table->date('employment_dob')->nullable();
            $table->string('employee_mobile', 30)->nullable();
            $table->string('national_id', 30)->nullable();
            $table->string('employee_email', 50)->nullable();
            $table->string('employee_disability', 150)->nullable();
            $table->string('employee_remark', 150)->nullable();
            $table->string('employee_address', 150)->nullable();
            $table->string('fathers_name', 150)->nullable();
            $table->string('mothers_name', 150)->nullable();
            $table->integer('family_members')->nullable();
            $table->integer('siblings_position')->nullable();
            $table->string('spouse_name', 150)->nullable();
            $table->integer('number_of_kids')->nullable();
            $table->string('employee_referred_by', 150)->nullable();
            $table->string('emergency_contact_details', 500)->nullable();
            $table->integer('employee_salary')->nullable();
            $table->string('employee_status', 50)->nullable();
            $table->string('action_type',50)->nullable();
            $table->string('user_id',200)->nullable();
            $table->date('action_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
