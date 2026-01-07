<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::table('effects', function (Blueprint $table) {
            $table->renameColumn('is_applied', 'is_consumed');
        });
    }

    public function down() {
        Schema::table('effects', function (Blueprint $table) {
            $table->renameColumn('is_consumed', 'is_applied');
        });
    }
};
