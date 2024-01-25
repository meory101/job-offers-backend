<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->bigInteger('offer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offer');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
