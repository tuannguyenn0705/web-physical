<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTagTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_and_delete_tags_via_json(): void
    {
        $admin = User::factory()->create();

        $createResponse = $this->actingAs($admin)->postJson(route('admin.tags.store'), [
            'name' => '#GPT-5 Omni',
        ]);

        $createResponse->assertOk()
            ->assertJson([
                'success' => true,
                'created' => true,
                'tag' => [
                    'name' => 'GPT-5 Omni',
                    'slug' => 'gpt-5-omni',
                ],
            ]);

        $tagId = $createResponse->json('tag.id');
        $this->assertDatabaseHas('tags', [
            'id' => $tagId,
            'name' => 'GPT-5 Omni',
            'slug' => 'gpt-5-omni',
        ]);

        $deleteResponse = $this->actingAs($admin)->deleteJson(route('admin.tags.destroy', $tagId));

        $deleteResponse->assertOk()
            ->assertJson([
                'success' => true,
                'id' => $tagId,
            ]);

        $this->assertDatabaseMissing('tags', [
            'id' => $tagId,
        ]);
    }
}
