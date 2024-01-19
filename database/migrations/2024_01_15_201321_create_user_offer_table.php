<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_offer', function (Blueprint $table) {
            $table->id();
            $table->boolean('res');
            $table->string('file_url');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('offer_id')->references('id')->on('offer');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_offer');
    }
};
