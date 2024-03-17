<?php

use App\Enums\Post\IsArchivedEnum;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->boolean("is_archived")->default(false);
            $table->timestamps();

            $table->index(["user_id"]);
            $table->index(["user_id", "is_archived"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
