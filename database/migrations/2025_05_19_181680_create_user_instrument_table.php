<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInstrumentTable extends Migration
{
    public function up()
    {
        Schema::create('instrument_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('instrument_id')->constrained()->onDelete('cascade');
            $table->primary(['user_id', 'instrument_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('instrument_user');
    }
}
