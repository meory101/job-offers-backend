<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('c_profile', function (Blueprint $table) {
            $table->id();
            $table->string('work_type');
            $table->string('lat');
            $table->string('long');
            $table->string('image_url');
            $table->string('cover_url');
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('c_profile');
    }
};
