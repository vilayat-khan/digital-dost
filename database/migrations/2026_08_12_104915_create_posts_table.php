<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->enum('type', ['article', 'review', 'news', 'buying_guide', 'tutorial', 'comparison'])->default('article');
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->string('featured_image')->nullable();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('schema_type')->default('Article');
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedInteger('reading_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};