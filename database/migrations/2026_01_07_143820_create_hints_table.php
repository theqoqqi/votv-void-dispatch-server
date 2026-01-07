<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Hint;

return new class extends Migration {

    public function up() {
        Schema::create('hints', function (Blueprint $table) {
            $table->id();

            $table->string('recipient_token')->index();

            $table->enum('type', Hint::TYPES);

            $table->text('text');

            $table->unsignedInteger('deliver_at_minutes');
            $table->boolean('is_consumed')->default(false);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('hints');
    }
};
