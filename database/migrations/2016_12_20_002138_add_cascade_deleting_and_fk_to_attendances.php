<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadeDeletingAndFkToAttendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            //user foreign key 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //event foreign key 
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign('users_user_id_foreign');
            $table->dropForeign('events_user_id_foreign');
        });
    }
}
