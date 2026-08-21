<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        DB::statement("
            UPDATE posts
            JOIN author_profiles ON author_profiles.user_id = posts.author_id
            SET posts.author_id = author_profiles.id
        ");

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('author_id')
                ->references('id')
                ->on('author_profiles')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        DB::statement("
            UPDATE posts
            JOIN author_profiles ON author_profiles.id = posts.author_id
            SET posts.author_id = author_profiles.user_id
        ");

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};