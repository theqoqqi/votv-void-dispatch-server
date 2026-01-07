<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::table('mails', function (Blueprint $table) {
            $table->renameColumn('is_read', 'is_consumed');
        });
    }

    public function down() {
        Schema::table('mails', function (Blueprint $table) {
            $table->renameColumn('is_consumed', 'is_read');
        });
    }
};
