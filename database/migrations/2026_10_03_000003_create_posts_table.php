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
            $table->string('title'); // Tiêu đề bài viết
            $table->string('slug')->unique(); // URL-friendly
            $table->text('excerpt')->nullable(); // Tóm tắt
            $table->longText('content'); // Nội dung bài viết
            $table->string('featured_image')->nullable(); // Ảnh đại diện
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Danh mục
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tác giả
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Trạng thái
            $table->enum('type', ['news', 'review', 'tutorial', 'update'])->default('news'); // Loại bài
            $table->unsignedBigInteger('views_count')->default(0); // Lượt xem
            $table->boolean('is_featured')->default(false); // Bài nổi bật
            $table->timestamp('published_at')->nullable(); // Ngày xuất bản
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
