<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('despawns', function (Blueprint $table) {
            $table->id();

            $table->string('recipient_token')->index();

            $table->string('name');

            $table->decimal('location_x', 10, 4);
            $table->decimal('location_y', 10, 4);
            $table->decimal('location_z', 10, 4);

            $table->decimal('tolerance_radius', 10, 4);

            $table->unsignedInteger('deliver_at_minutes');
            $table->boolean('is_consumed')->default(false);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('despawns');
    }
};
