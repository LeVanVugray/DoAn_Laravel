<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('email');
            $table->string('facebook_id')->nullable()->after('google_id');
        });
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'facebook_id']);
        });
    }
};
