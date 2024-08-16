<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 
    public function up():void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->enum('content_type', ['text', 'video', 'image', 'video/image']);
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->text('custom_content')->nullable();
            $table->integer('rank')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content');
    }
};
