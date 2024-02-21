<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->integer('diamond_weekly')->default(0);
            $table->integer('diamond_twoweeks')->default(0);
            $table->integer('diamond_montly')->default(0);
            $table->integer('diamond_yearly')->default(0);
            $table->string('entry_pic', 100)->nullable();
            $table->string('entry_json', 100)->nullable();
            $table->string('entry_music', 100)->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('entries');
    }
}
