<?php

use App\Models\Effect;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('effects', function (Blueprint $table) {
            $table->id();

            $table->string('recipient_token')->index();

            $table->enum('property', Effect::PROPERTIES);
            $table->text('value')->nullable();

            $table->unsignedInteger('deliver_at_minutes');
            $table->boolean('is_applied')->default(false);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('effects');
    }
};
