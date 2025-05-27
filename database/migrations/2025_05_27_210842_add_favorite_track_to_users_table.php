<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFavoriteTrackToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('favorite_track_id')->nullable()->after('spotify_token');
            $table->string('favorite_track_name')->nullable()->after('favorite_track_id');
            $table->string('favorite_track_url')->nullable()->after('favorite_track_name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['favorite_track_id', 'favorite_track_name', 'favorite_track_url']);
        });
    }
}