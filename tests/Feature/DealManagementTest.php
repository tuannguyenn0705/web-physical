<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DealManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_deals_page_displays_active_deals_with_hakoreview_card_elements(): void
    {
        $activeDeal = Deal::factory()->create([
            'title' => '60%OFF at Cursor Pro AI',
            'description' => 'Best-selling AI IDE 60% off',
            'affiliate_url' => 'https://cursor.com/?ref=testref',
            'badge_text' => 'Deal',
            'sub_badge_text' => 'DISCOUNT DEAL',
            'button_text' => 'Shop Now',
            'is_active' => true,
        ]);

        $inactiveDeal = Deal::factory()->create([
            'title' => 'Hidden Expired Deal',
            'is_active' => false,
        ]);

        $response = $this->get(route('deals.index'));

        $response->assertStatus(200);
        $response->assertSee('60%OFF at Cursor Pro AI');
        $response->assertSee('Best-selling AI IDE 60% off');
        $response->assertSee('DISCOUNT DEAL');
        $response->assertSee('Shop Now');
        $response->assertSee('https://cursor.com/?ref=testref');
        $response->assertDontSee('Hidden Expired Deal');
    }

    public function test_admin_can_create_update_and_delete_deals(): void
    {
        $admin = User::factory()->create();

        // Create deal
        $storeResponse = $this->actingAs($admin)->post(route('admin.deals.store'), [
            'title' => '50%OFF at Jasper AI',
            'description' => 'Save 50% on annual creator plan',
            'affiliate_url' => 'https://jasper.ai/?ref=myref',
            'badge_text' => 'Deal',
            'sub_badge_text' => 'DISCOUNT DEAL',
            'button_text' => 'Shop Now',
            'order' => 1,
            'is_active' => '1',
        ]);

        $storeResponse->assertRedirect(route('admin.deals.index'));
        $this->assertDatabaseHas('deals', [
            'title' => '50%OFF at Jasper AI',
            'affiliate_url' => 'https://jasper.ai/?ref=myref',
            'is_active' => true,
        ]);

        $deal = Deal::firstOrFail();

        // Update deal
        $updateResponse = $this->actingAs($admin)->put(route('admin.deals.update', $deal), [
            'title' => '70%OFF at Jasper AI Pro',
            'description' => 'Updated description',
            'affiliate_url' => 'https://jasper.ai/?ref=updatedref',
            'badge_text' => 'Deal',
            'sub_badge_text' => 'DISCOUNT DEAL',
            'button_text' => 'Shop Now',
            'order' => 2,
            'is_active' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.deals.index'));
        $this->assertDatabaseHas('deals', [
            'id' => $deal->id,
            'title' => '70%OFF at Jasper AI Pro',
            'affiliate_url' => 'https://jasper.ai/?ref=updatedref',
        ]);

        // Delete deal
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.deals.destroy', $deal));
        $deleteResponse->assertRedirect(route('admin.deals.index'));
        $this->assertDatabaseMissing('deals', ['id' => $deal->id]);
    }

    public function test_update_post_type_is_no_longer_accepted(): void
    {
        $admin = User::factory()->create();
        $category = Category::create([
            'name' => 'AI Tools',
            'slug' => 'ai-tools',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.posts.store'), [
            'title' => 'Should Fail Update Type',
            'content' => '<p>Content</p>',
            'category_id' => $category->id,
            'type' => 'update',
            'status' => 'published',
        ]);

        $response->assertSessionHasErrors('type');
    }

    public function test_deals_paginate_15_per_page_with_custom_pagination_bar(): void
    {
        Deal::factory()->count(20)->create([
            'is_active' => true,
        ]);

        $response = $this->get(route('deals.index'));

        $response->assertStatus(200);
        $response->assertSeeText('Showing 1 to 15 of 20 results');
        $response->assertSee('?page=2', false);
    }

    public function test_deal_click_tracking_increments_clicks_and_redirects(): void
    {
        $deal = Deal::factory()->create([
            'affiliate_url' => 'https://cursor.com/?ref=clicktest',
            'clicks_count' => 0,
        ]);

        $response = $this->get(route('deals.go', $deal));

        $response->assertRedirect('https://cursor.com/?ref=clicktest');
        $this->assertDatabaseHas('deals', [
            'id' => $deal->id,
            'clicks_count' => 1,
        ]);
    }

    public function test_static_trust_and_legal_pages_and_sitemap_are_accessible(): void
    {
        $slugs = [
            'about-us',
            'contact',
            'affiliate-disclosure',
            'privacy-policy',
            'terms-of-service',
        ];

        foreach ($slugs as $slug) {
            $this->get(route('pages.show', $slug))->assertStatus(200);
        }

        $sitemapResponse = $this->get(route('sitemap'));
        $sitemapResponse->assertStatus(200);
        $sitemapResponse->assertSee('<urlset', false);
    }

    public function test_visitor_can_subscribe_to_newsletter(): void
    {
        $response = $this->post(route('newsletter.subscribe'), [
            'email' => 'reader@example.com',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('subscribers', [
            'email' => 'reader@example.com',
            'is_active' => true,
        ]);
    }
}
