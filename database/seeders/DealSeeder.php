<?php

namespace Database\Seeders;

use App\Models\Deal;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Seed verified physical product retail deals & promo codes.
     */
    public function run(): void
    {
        Deal::query()->delete();

        $sampleDeals = [
            [
                'title' => 'Sony WH-1000XM5 Wireless ANC Headphones — $298 (Save $102)',
                'description' => 'Lowest verified street price of the season on Sony’s #1 rated 30-hour noise-canceling headphones with carry case.',
                'image' => '/images/deals/sony-xm5.svg',
                'affiliate_url' => 'https://www.amazon.com/dp/B09XS7JWHH?tag=verdictlab-20',
                'coupon_code' => 'SONYXM5DEAL',
                'badge_text' => '26% OFF',
                'sub_badge_text' => 'Amazon Official',
                'button_text' => 'Check Amazon Price',
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Roborock S8 MaxV Ultra Robot Vacuum & Hot-Wash Dock — $300 OFF',
                'description' => 'Flagship 10,000Pa robot vacuum with robotic corner brush and 140°F self-washing dock at an all-time low price.',
                'image' => '/images/deals/roborock.svg',
                'affiliate_url' => 'https://www.amazon.com/s?k=Roborock+S8+MaxV+Ultra&tag=verdictlab-20',
                'coupon_code' => 'ROBOLAB300',
                'badge_text' => 'SAVE $300',
                'sub_badge_text' => 'Best Buy & Amazon',
                'button_text' => 'Claim $300 Off',
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Keychron Q1 Max QMK/VIA Wireless Custom CNC Aluminum Keyboard',
                'description' => 'Take 15% off all fully assembled Gateron Jupiter Banana & Red switch editions with 2.4GHz 1000Hz receiver.',
                'image' => '/images/deals/keychron.svg',
                'affiliate_url' => 'https://www.keychron.com/products/keychron-q1-max-qmk-via-wireless-custom-mechanical-keyboard',
                'coupon_code' => 'VERDICT15',
                'badge_text' => '15% OFF',
                'sub_badge_text' => 'Direct Brand Store',
                'button_text' => 'Shop Keychron',
                'order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Breville Barista Express Impress Espresso Machine — Save $150',
                'description' => 'Brushed stainless steel espresso machine with integrated conical burr grinder and assisted 22lb tamping system.',
                'image' => '/images/deals/breville.svg',
                'affiliate_url' => 'https://www.amazon.com/s?k=Breville+Barista+Express+Impress&tag=verdictlab-20',
                'coupon_code' => null,
                'badge_text' => 'SAVE $150',
                'sub_badge_text' => 'Amazon Kitchen',
                'button_text' => 'View Deal',
                'order' => 4,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Anker Prime 27,650mAh (250W) Power Bank + 100W Charging Base',
                'description' => 'TSA carry-on approved 99.54Wh fast-charging laptop power bank with smart OLED telemetry screen.',
                'image' => '/images/deals/anker-gan.svg',
                'affiliate_url' => 'https://www.amazon.com/s?k=Anker+Prime+27650mAh+Power+Bank&tag=verdictlab-20',
                'coupon_code' => 'ANKERLAB28',
                'badge_text' => '28% OFF',
                'sub_badge_text' => 'Amazon Official',
                'button_text' => 'Claim Bundle Deal',
                'order' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Herman Miller Aeron & Workspace Ergonomics Sale — 25% OFF + Free Shipping',
                'description' => 'Save 25% sitewide on custom-configured Herman Miller Aeron, Embody, and Jarvis standing desks with 12-year warranty.',
                'image' => '/images/deals/herman-miller.svg',
                'affiliate_url' => 'https://store.hermanmiller.com/',
                'coupon_code' => 'ERGO25',
                'badge_text' => '25% OFF',
                'sub_badge_text' => 'Authorized Store',
                'button_text' => 'Shop Sale',
                'order' => 6,
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($sampleDeals as $dealData) {
            Deal::create($dealData);
        }
    }
}
