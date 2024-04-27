<?php

use App\Enums\StoryMedia\StoryMediaEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_story_medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId("story_id")->constrained("stories")->onDelete("cascade");
            $table->string("path");
            $table->enum("media_type", StoryMediaEnum::toArrayAllValues());
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
        Schema::dropIfExists('user_story_media');
    }
};
