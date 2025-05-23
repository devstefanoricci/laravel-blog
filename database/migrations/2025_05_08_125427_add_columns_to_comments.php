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
        Schema::table('comments', function (Blueprint $table) {
            $table->string('title');
            $table->text('body');
            $table->foreignId('post_id');
            $table->foreignId('user_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('body');
            $table->dropConstrainedForeignId('post_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn('deleted_at');
        });
    }
};
