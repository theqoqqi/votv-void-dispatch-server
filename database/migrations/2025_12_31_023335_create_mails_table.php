<?php

use App\Models\Mail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();

            $table->string('recipient_token')->index();

            $table->enum('sender', Mail::SENDERS);

            $table->string('subject');
            $table->text('body');

            $table->unsignedInteger('deliver_at_minutes');
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('mails');
    }
};
