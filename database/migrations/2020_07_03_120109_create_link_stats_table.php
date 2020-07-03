<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->ipAddress('ip');
            $table->boolean('is_robot')->default(false);
            $table->boolean('is_phone')->default(false);
            $table->boolean('is_desktop')->default(false);
            $table->string('device_nmae')->nullable();
            $table->string('platform_name')->nullable();
            $table->string('browser_name')->nullable(); 
            $table->timestamps();

            $table->engine = 'InnoDB';	

            $table->foreign('link_id')->references('id')->on('links');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_stats');
    }
}
