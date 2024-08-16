<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('payment_type');
            $table->string('product_id')->unique();
            $table->string('update_id')->nullable();
            $table->string('unlimited_subdomain_id')->nullable();
            $table->string('support_id')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_free')->default(false)->nullable();
            $table->integer('rank')->default(0);
            $table->string('custom_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

