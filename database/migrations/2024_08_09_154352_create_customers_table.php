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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->date('registration_date');
            $table->string('customer_name', 300);
            $table->string('proprietor_name', 500)->nullable();
            $table->double('loyalty_discount',8,2)->nullable();
            $table->date('customer_dob')->nullable();
            $table->string('customer_phone',50)->nullable();
            $table->string('national_id', 50)->nullable();
            $table->string('passport_no',50)->nullable();
            $table->string('blood_group',50)->nullable();
            $table->string('customer_email',50)->nullable();
            $table->string('customer_disability',300)->nullable();
            $table->string('customer_remark',500)->nullable();
            $table->string('customer_address',500)->nullable();
            $table->string('fathers_name',150)->nullable();
            $table->string('mothers_name',150)->nullable();
            $table->integer('family_members')->nullable();
            $table->integer('siblings_position')->nullable();
            $table->string('spouse_name',150)->nullable();
            $table->integer('number_of_kids')->nullable();
            $table->string('customer_grade',10)->nullable();
            $table->string('customer_referred_by',150)->nullable();
            $table->string('emergency_contact_details',500)->nullable();
            $table->double('set_reminder_amount',8,2)->nullable();
            $table->string('customer_note',500)->nullable();
            $table->string('customer_image',500)->nullable();
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
        Schema::dropIfExists('customers');
    }
};
