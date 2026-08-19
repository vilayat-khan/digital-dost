<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('posts', 'views')) {
                $table->integer('views')->default(0);
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'show_on_home')) {
                $table->boolean('show_on_home')->default(false);
            }
            if (!Schema::hasColumn('categories', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'is_featured')) {
                $table->dropColumn('is_featured');
            }
            if (Schema::hasColumn('posts', 'views')) {
                $table->dropColumn('views');
            }
        });
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'show_on_home')) {
                $table->dropColumn('show_on_home');
            }
            if (Schema::hasColumn('categories', 'sort_order')) {
                $table->dropColumn('sort_order');
            }
        });
    }
};