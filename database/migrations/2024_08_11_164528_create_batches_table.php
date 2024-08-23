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
        Schema::create('batches', function (Blueprint $table) {
            $table->id('batch_id');
            $table->date('registration_date');
            $table->date('production_date');
            $table->date('expire_date');
            $table->integer('product_id');
            $table->integer('customer_id');
            $table->string('batch_title',300);
            $table->string('batch_no',200);
            $table->integer('batch_packing')->nullable();
            $table->string('remark',500)->nullable();
            $table->string('import_info',500)->nullable();
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
        Schema::dropIfExists('batches');
    }
};
