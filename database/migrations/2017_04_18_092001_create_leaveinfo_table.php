<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaveinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('allow_leave')->default(0);
            $table->integer('no_app')->default(0);
            $table->integer('remaining_leave')->default(0);
            $table->integer('accepted_leave')->default(0);
            $table->integer('rejected_leave')->default(0);
            $table->integer('pending_leave')->default(0);
            $table->integer('emergency_leave')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaveinfo');
    }
}
