<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->string('title', 255);
            $table->text('tags')->nullable();
            $table->enum('live_type', ['A', 'V'])->nullable()->comment('A - Audio, V - Video')->default('A');
            $table->string('username', 255);
            $table->integer('userid')->nullable();
            $table->text('profile_url')->nullable();
            $table->integer('room_id')->nullable();
            $table->integer('level')->nullable();
            $table->enum('call_status', ['S', 'E', 'R'])->nullable()->comment('S - Started, E - Ended, R- running')->default('S');
            $table->enum('user_status', ['H', 'S', 'A'])->nullable()->comment('H - Host, S - Speaker, A- Audience')->default('S');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
