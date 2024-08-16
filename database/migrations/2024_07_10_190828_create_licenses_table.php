<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_key')->unique();
            $table->string('license_name');
            $table->string('transaction')->unique();
            $table->string('subscriber_code')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->date('expiration_date');
            $table->string('email');
            $table->string('client_name');
            $table->unsignedBigInteger('offer_id');
            $table->string('verification_code')->nullable();
            $table->double('total_amount')->nullable(); 
            $table->timestamps();

            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}


