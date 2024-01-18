<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('offer', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('hashtag');
            $table->string('image_url');
            $table->string('date');
            $table->bigInteger('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('c_profile');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer');
    }
};
