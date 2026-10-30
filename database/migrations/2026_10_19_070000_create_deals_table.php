<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('affiliate_url');
            $table->string('badge_text')->default('Deal');
            $table->string('sub_badge_text')->default('DISCOUNT DEAL');
            $table->string('button_text')->default('Shop Now');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Xóa toàn bộ bài viết và danh mục liên quan đến "Cập nhật" (update)
        if (Schema::hasTable('posts')) {
            $updatePostIds = DB::table('posts')->where('type', 'update')->pluck('id');
            if ($updatePostIds->isNotEmpty() && Schema::hasTable('post_tag')) {
                DB::table('post_tag')->whereIn('post_id', $updatePostIds)->delete();
            }
            if ($updatePostIds->isNotEmpty() && Schema::hasTable('comments')) {
                DB::table('comments')->whereIn('post_id', $updatePostIds)->delete();
            }
            DB::table('posts')->where('type', 'update')->delete();
        }

        if (Schema::hasTable('categories')) {
            DB::table('categories')
                ->where('slug', 'cap-nhat')
                ->orWhere('slug', 'cap-nhat-ai')
                ->orWhere('name', 'like', '%Cập nhật%')
                ->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
