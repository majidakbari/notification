<?php

use App\Entities\Notification;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->string('name');
            $table->text('message');
            $table->unsignedTinyInteger('type')->comment(
                Notification::TYPE_SMS . '=' . Notification::TYPE_SMS_LABEL . ',' .
                Notification::TYPE_EMAIL . '=' . Notification::TYPE_EMAIL_LABEL
            );
            $table->boolean('sent');
            $table->string('message_key')->index();
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
        Schema::dropIfExists('notifications');
    }
}
