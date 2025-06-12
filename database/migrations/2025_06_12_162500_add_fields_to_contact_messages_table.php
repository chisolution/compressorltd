<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('company')->nullable()->after('phone');
            $table->foreignId('branch_id')->nullable()->after('message')->constrained()->nullOnDelete();
            $table->enum('inquiry_type', ['general', 'quote', 'support', 'partnership', 'other'])->default('general')->after('branch_id');
            $table->string('ip_address')->nullable()->after('status');
            $table->string('user_agent')->nullable()->after('ip_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn(['company', 'branch_id', 'inquiry_type', 'ip_address', 'user_agent']);
        });
    }
};
