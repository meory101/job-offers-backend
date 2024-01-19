<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('u_profile', function (Blueprint $table) {
            $table->id();
            $table->string('graduated_at');
            $table->string('worked_at');
            $table->string('cv_url');
            $table->string('image_url');
            $table->string('cover_url');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('u_profile');
    }
};
