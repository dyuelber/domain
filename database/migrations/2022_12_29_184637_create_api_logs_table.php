<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->string('ip')->nullable();
            $table->string('method')->nullable();
            $table->string('url')->nullable();
            $table->integer('code')->nullable();
            $table->string('duration')->nullable();
            $table->string('controller')->nullable();
            $table->string('action')->nullable();
            $table->json('payload')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_logs');
    }
};
