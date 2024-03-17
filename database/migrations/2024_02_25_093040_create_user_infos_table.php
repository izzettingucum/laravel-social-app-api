<?php

use App\Enums\UserInfo\GenderEnum;
use App\Enums\UserInfo\IsHiddenEnum;
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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->date("birthday");
            $table->enum("gender", GenderEnum::toArrayAllValues());
            $table->boolean("is_hidden")->default(false);
            $table->timestamps();

            $table->index(["name"]);
            $table->index(["user_id"]);
            $table->index(["birthday"]);
            $table->index(["gender"]);
            $table->index(["is_hidden"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
};
