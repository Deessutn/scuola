<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandUserTable extends Migration
{
    public function up()
    {
        Schema::create('band_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('band_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['band_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('band_user');
    }
}
