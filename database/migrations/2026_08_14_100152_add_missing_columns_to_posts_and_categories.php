<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(false);
            $table->integer('sort_order')->default(0);
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'views']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['show_on_home', 'sort_order']);
        });
    }
};
