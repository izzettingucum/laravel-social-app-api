<?php

use App\Enums\FollowRequest\ApprovalStatusEnum;
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
        Schema::create('follow_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sender_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("reciever_id")->constrained("users")->onDelete("cascade");
            $table->enum("approval_status", ApprovalStatusEnum::toArrayAllValues())->default(ApprovalStatusEnum::getApprovalPending());
            $table->timestamps();

            $table->index(["sender_id"]);
            $table->index(["reciever_id"]);
            $table->index(["sender_id", "reciever_id"]);
            $table->index(["sender_id", "approval_status"]);
            $table->index(["reciever_id", "approval_status"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_requests');
    }
};
