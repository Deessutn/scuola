<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestApplicationsTable extends Migration
{
    public function up()
{
    Schema::create('request_applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('request_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
        $table->timestamps();

        $table->unique(['user_id', 'request_id']); // Evita doppie candidature
    });
}

    public function down()
    {
        Schema::dropIfExists('request_applications');
    }
}
