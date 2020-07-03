<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->ipAddress('ip');
            $table->string('url', 2083);
            $table->string('custom', 25)->unique()->index();
            $table->integer('total_uses')->nullable();
            $table->integer('used')->default(0);
            $table->dateTime('expire_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';	

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
        Schema::dropIfExists('links');
    }
}
