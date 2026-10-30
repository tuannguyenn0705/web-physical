<?php

namespace Database\Seeders;

use App\Models\Deal;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Seed dữ liệu mẫu cho trang Deals AI
     */
    public function run(): void
    {
        if (Deal::count() > 0) {
            return;
        }

        $sampleDeals = [
            [
                'title' => '50%OFF at Cursor Pro AI',
                'description' => 'Best-selling AI code editor 50% off for annual subscription',
                'image' => '/images/deals/cursor.svg',
                'affiliate_url' => 'https://cursor.com/?ref=aihubinsider',
                'badge_text' => 'Deal',
                'sub_badge_text' => 'DISCOUNT DEAL',
                'button_text' => 'Shop Now',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => '60%OFF at Jasper AI Creator',
                'description' => 'Save 60% on AI marketing & copywriting workspace plans',
                'image' => '/images/deals/jasper.svg',
                'affiliate_url' => 'https://jasper.ai/?ref=aihubinsider',
                'badge_text' => 'Deal',
                'sub_badge_text' => 'DISCOUNT DEAL',
                'button_text' => 'Shop Now',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => '40%OFF at ElevenLabs Voice AI',
                'description' => 'Get 40% off your first 3 months of AI voice generation',
                'image' => '/images/deals/elevenlabs.svg',
                'affiliate_url' => 'https://elevenlabs.io/?ref=aihubinsider',
                'badge_text' => 'Deal',
                'sub_badge_text' => 'DISCOUNT DEAL',
                'button_text' => 'Shop Now',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => '30%OFF at Midjourney Pro Plan',
                'description' => 'Exclusive 30% discount on annual AI image generation plan',
                'image' => '/images/deals/midjourney.svg',
                'affiliate_url' => 'https://midjourney.com/?ref=aihubinsider',
                'badge_text' => 'Deal',
                'sub_badge_text' => 'DISCOUNT DEAL',
                'button_text' => 'Shop Now',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => '70%OFF at Perplexity Pro AI',
                'description' => 'Unlimited AI research & GPT-5/Claude 4 search assistant discount',
                'image' => '/images/deals/perplexity.svg',
                'affiliate_url' => 'https://perplexity.ai/?ref=aihubinsider',
                'badge_text' => 'Deal',
                'sub_badge_text' => 'DISCOUNT DEAL',
                'button_text' => 'Shop Now',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => '45%OFF at Runway Gen-3 Studio',
                'description' => 'Create cinematic AI videos with 45% off Unlimited plan',
                'image' => '/images/deals/runway.svg',
                'affiliate_url' => 'https://runwayml.com/?ref=aihubinsider',
                'badge_text' => 'Deal',
                'sub_badge_text' => 'DISCOUNT DEAL',
                'button_text' => 'Shop Now',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($sampleDeals as $dealData) {
            Deal::create($dealData);
        }
    }
}
