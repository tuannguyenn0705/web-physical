<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPostManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard_or_posts(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/posts');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'adminaihub@gmail.com',
            'password' => bcrypt('Tuan2006@'),
        ]);

        $response = $this->post('/login', [
            'email' => 'adminaihub@gmail.com',
            'password' => 'Tuan2006@',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_rejects_bots_filling_honeypot(): void
    {
        $this->post('/login', [
            'email' => 'adminaihub@gmail.com',
            'password' => 'Tuan2006@',
            'website_url_hp' => 'http://spam-bot.com',
        ]);

        $this->assertGuest();
    }

    public function test_authenticated_user_can_view_post_list_and_create_post(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Tin tức AI',
            'slug' => 'tin-tuc-ai',
        ]);

        $this->actingAs($user);

        $response = $this->get('/admin/posts');
        $response->assertStatus(200);

        $createResponse = $this->post('/admin/posts', [
            'title' => 'Bài viết thử nghiệm bảo mật',
            'type' => 'news',
            'status' => 'published',
            'category_id' => $category->id,
            'excerpt' => 'Tóm tắt bài viết thử nghiệm',
            'content' => 'Nội dung chi tiết của bài viết thử nghiệm',
        ]);

        $createResponse->assertRedirect('/admin/posts');
        $this->assertDatabaseHas('posts', [
            'title' => 'Bài viết thử nghiệm bảo mật',
            'type' => 'news',
            'status' => 'published',
        ]);
    }

    public function test_authenticated_user_can_upload_inline_image_for_post_content(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('diagram.png', 800, 600);

        $response = $this->postJson('/admin/posts/upload-image', [
            'image' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'url']);
        $this->assertTrue($response->json('success'));
    }

    public function test_client_post_detail_page_renders_successfully(): void
    {
        $category = Category::create([
            'name' => 'Review AI',
            'slug' => 'review-ai',
        ]);

        $user = User::factory()->create();

        $post = Post::create([
            'title' => 'Đánh giá chi tiết Claude 3.7 Sonnet',
            'slug' => 'danh-gia-chi-tiet-claude-3-7-sonnet',
            'excerpt' => 'Mô hình lai suy nghĩ và hành động hàng đầu',
            'content' => '<p>Nội dung chi tiết bài viết với <strong>định dạng đậm</strong>.</p>',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'type' => 'review',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $relatedPost = Post::create([
            'title' => 'Khảo sát GPT-4.5',
            'slug' => 'khao-sat-gpt-4-5',
            'excerpt' => 'Tin tức cập nhật mới',
            'content' => '<p>Nội dung liên quan</p>',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'type' => 'news',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/posts/'.$post->slug);

        $response->assertStatus(200);
        $response->assertSee('Đánh giá chi tiết Claude 3.7 Sonnet');
        $response->assertSee('Related Articles');
        $response->assertSee('Khảo sát GPT-4.5');
    }

    public function test_admin_post_create_and_edit_views_render_quill_editor(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::create([
            'name' => 'Hướng dẫn AI',
            'slug' => 'huong-dan-ai',
        ]);

        $post = Post::create([
            'title' => 'Hướng dẫn tạo Agent AI',
            'slug' => 'huong-dan-tao-agent-ai',
            'excerpt' => 'Các bước tạo custom agent',
            'content' => '<p>Hướng dẫn chi tiết từng bước...</p>',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'type' => 'tutorial',
            'status' => 'draft',
        ]);

        $createResponse = $this->get('/admin/posts/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('quill.js');
        $createResponse->assertSee('quillEditorContainer');

        $editResponse = $this->get('/admin/posts/'.$post->id.'/edit');
        $editResponse->assertStatus(200);
        $editResponse->assertSee('quill.js');
        $editResponse->assertSee('Hướng dẫn chi tiết từng bước...');
    }
}
