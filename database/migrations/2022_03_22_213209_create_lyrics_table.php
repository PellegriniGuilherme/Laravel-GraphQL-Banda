<?php

use App\Models\Music;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLyricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lyrics', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('language', 5);
            $table->text('lyric');
            
            $table->foreignIdFor(Music::class);
            $table->timestamps();
            $table->foreign('music_id')->references('id')->on('musics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lyrics');
    }
}
