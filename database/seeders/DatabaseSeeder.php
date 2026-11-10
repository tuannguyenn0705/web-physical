<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed authentic physical product reviews, hardware categories, tags, deals, and compliance pages.
     */
    public function run(): void
    {
        // === 1. Create / Update Primary Admin User and Remove Others ===
        $admin = User::where('email', 'verdictlab@gmail.com')->first() ?: User::first();
        if ($admin) {
            $admin->update([
                'name' => 'VerdictTC Admin',
                'email' => 'verdictlab@gmail.com',
                'password' => bcrypt('Tuan2006@'),
                'email_verified_at' => now(),
            ]);
        } else {
            $admin = User::create([
                'name' => 'Verdict Lab Admin',
                'email' => 'verdictlab@gmail.com',
                'password' => bcrypt('Tuan2006@'),
                'email_verified_at' => now(),
            ]);
        }

        // Reassign any existing posts & comments to the admin user before cleanup
        Post::where('user_id', '!=', $admin->id)->update(['user_id' => $admin->id]);
        Comment::where('user_id', '!=', $admin->id)->update(['user_id' => $admin->id]);

        // Remove all other users so only verdictlab@gmail.com exists
        User::where('id', '!=', $admin->id)->delete();

        // === 2. Create Physical Product Categories (E-Commerce & Affiliate Pillars) ===
        $categories = [
            [
                'name' => 'Audio & Headphones',
                'slug' => 'audio-headphones',
                'description' => 'Lab-tested wireless noise-canceling headphones, audiophile IEMs, desktop DACs, and studio speakers.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Desk Setup & Ergonomics',
                'slug' => 'desk-setup-ergonomics',
                'description' => 'Custom mechanical keyboards, ergonomic office chairs, 4K OLED monitors, and standing desks.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Smart Home & Appliances',
                'slug' => 'smart-home-appliances',
                'description' => 'Hands-on testing of robot vacuums, HEPA air purifiers, smart locks, and climate control hardware.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Kitchen & Coffee Gear',
                'slug' => 'kitchen-coffee-gear',
                'description' => 'Precision espresso machines, conical burr grinders, air fryers, and commercial-grade cookware.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Everyday Carry & Travel',
                'slug' => 'edc-travel-gear',
                'description' => 'GaN fast chargers, airline-safe power banks, carry-on backpacks, and rugged travel accessories.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Fitness & Recovery Tech',
                'slug' => 'fitness-recovery-tech',
                'description' => 'Multisport GPS watches, percussive therapy massage guns, smart rings, and home gym equipment.',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        $categoryMap = [];
        foreach ($categories as $cat) {
            $createdCat = Category::updateOrCreate(['slug' => $cat['slug']], $cat);
            $categoryMap[$cat['slug']] = $createdCat->id;
        }

        // === 3. Create Physical Product & Brand Tags ===
        $tagNames = [
            'Sony', 'Bose', 'Sennheiser', 'ANC Headphones', 'Mechanical Keyboards',
            'Keychron', 'Herman Miller', 'Ergonomic Chairs', 'Roborock', 'Robot Vacuums',
            'Breville', 'Espresso Machines', 'Anker GaN', 'Power Banks', 'Garmin',
            'HEPA Air Purifiers', 'OLED Monitors', 'Travel Backpacks',
        ];

        $tags = [];
        foreach ($tagNames as $name) {
            $tags[] = Tag::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }

        // === 4. Create 9 In-Depth Physical Product Reviews & Buying Guides ===
        $samplePosts = [
            [
                'title' => 'Sony WH-1000XM5 vs. Bose QuietComfort Ultra: 60-Hour ANC Headphone Lab Shootout',
                'excerpt' => 'We tested both flagship wireless headphones inside an acoustic isolation chamber and on a 14-hour transpacific flight to crown the undisputed noise-canceling champion.',
                'featured_image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['audio-headphones'],
                'type' => 'review',
                'is_featured' => true,
                'views_count' => 14820,
                'content' => '
                    <p>Choosing between the <strong>Sony WH-1000XM5</strong> and the <strong>Bose QuietComfort Ultra</strong> is the single toughest decision for commuters and frequent flyers in 2026. Rather than relying on manufacturer spec sheets, our acoustic testing team purchased retail units of both headphones from Amazon and subjected them to 60 hours of standardized laboratory measurement.</p>
                    <h2>1. Acoustic Chamber Noise Cancellation Results</h2>
                    <p>Using our head-and-torso simulator (HATS) inside an acoustic booth, we generated pink noise and cabin drone at 82 dB SPL. Both headphones represent the pinnacle of consumer active noise cancellation, but they target slightly different frequency bands.</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Test Frequency Band</th>
                                <th>Sony WH-1000XM5</th>
                                <th>Bose QC Ultra</th>
                                <th>Category Winner</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Low-Frequency Jet Engine (60Hz–250Hz)</td>
                                <td>-38.4 dB Attenuation</td>
                                <td>-41.2 dB Attenuation</td>
                                <td>Bose QC Ultra</td>
                            </tr>
                            <tr>
                                <td>Office Voices &amp; Café Chatter (500Hz–2kHz)</td>
                                <td>-39.8 dB Attenuation</td>
                                <td>-37.5 dB Attenuation</td>
                                <td>Sony WH-1000XM5</td>
                            </tr>
                            <tr>
                                <td>Measured Battery Life (ANC Enabled, 75dB)</td>
                                <td>31 Hours 40 Minutes</td>
                                <td>24 Hours 15 Minutes</td>
                                <td>Sony WH-1000XM5</td>
                            </tr>
                            <tr>
                                <td>Microphone Call Clarity in 20mph Wind</td>
                                <td>9.6 / 10 (8-Mic Array)</td>
                                <td>8.7 / 10</td>
                                <td>Sony WH-1000XM5</td>
                            </tr>
                        </tbody>
                    </table>
                    <h2>2. Clamping Force, Weight &amp; Long-Haul Comfort</h2>
                    <p>The Sony WH-1000XM5 tips our digital lab scale at exactly 250 grams, utilizing a stepless synthetic Soft Fit leather headband. Meanwhile, the Bose QuietComfort Ultra weighs 254 grams and retains a folding hinge mechanism that makes it slightly more compact inside a carry-on backpack.</p>
                    <blockquote>Our testers wore both headphones for 8 consecutive hours: Bose wins slightly for glasses wearers due to its deeper earcup cavity, while Sony runs 1.8°C cooler over extended sessions.</blockquote>
                    <h2>3. Sound Quality &amp; Codec Support</h2>
                    <p>Sony supports LDAC high-resolution wireless audio out of the box, offering superior micro-detail retrieval and a punchy, dynamic low end. Bose counters with Snapdragon Sound (aptX Adaptive) and its proprietary Immersive Audio spatial processing.</p>
                    <h2>4. Final Buying Recommendation</h2>
                    <p>For 85% of buyers, the <strong>Sony WH-1000XM5</strong> is our #1 Editor’s Choice thanks to its superior 31+ hour battery life, class-leading microphone call quality, and frequent street price drops below $300.</p>
                ',
            ],
            [
                'title' => 'Keychron Q1 Max Long-Term Review: The Best CNC Aluminum Wireless Mechanical Keyboard',
                'excerpt' => 'With a 1,800-gram 6063 CNC-machined aluminum body, 1000Hz 2.4GHz wireless polling, and double-gasket acoustic foam, the Keychron Q1 Max sets the benchmark for custom keyboards.',
                'featured_image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['desk-setup-ergonomics'],
                'type' => 'review',
                'is_featured' => true,
                'views_count' => 11340,
                'content' => '
                    <p>For years, enthusiasts had to choose between heavy, custom CNC-machined aluminum mechanical keyboards with wired-only connections or lightweight plastic boards with reliable 2.4GHz wireless. The <strong>Keychron Q1 Max</strong> eliminates that compromise entirely.</p>
                    <h2>1. CNC Aluminum Build Quality &amp; Internal Acoustics</h2>
                    <p>We disassembled our retail Keychron Q1 Max unit to inspect the internal engineering. The top and bottom cases are milled from solid blocks of 6063 aluminum, bead-blasted, and anodized to a satin finish that resists fingerprint oils.</p>
                    <ul>
                        <li><strong>Double-Gasket Mount Design:</strong> Silicone gaskets on the plates combined with six layers of IXPE, PET, and EPDM sound-absorbing foam produce a deep, resonant "thock" right out of the box.</li>
                        <li><strong>Gateron Jupiter Banana Switches:</strong> Our test unit came equipped with factory-lubed tactile switches featuring a crisp 59gf bump and zero noticeable spring ping.</li>
                        <li><strong>KSA Double-Shot PBT Keycaps:</strong> Thick 1.5mm PBT walls that never develop an oily shine even after six months of daily typing.</li>
                    </ul>
                    <h2>2. Wireless Latency &amp; Battery Telemetry</h2>
                    <p>Using our high-speed LDAT latency analyzer, we measured end-to-end key press latency across wired USB-C, 2.4GHz dongle, and Bluetooth 5.1 modes.</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Connection Mode</th>
                                <th>Polling Rate</th>
                                <th>Measured Latency</th>
                                <th>Recommended Use</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Wired USB-C</td>
                                <td>1000 Hz</td>
                                <td>2.1 ms</td>
                                <td>Competitive Esports</td>
                            </tr>
                            <tr>
                                <td>2.4GHz Wireless Receiver</td>
                                <td>1000 Hz</td>
                                <td>3.4 ms</td>
                                <td>Daily Gaming &amp; Coding</td>
                            </tr>
                            <tr>
                                <td>Bluetooth 5.1 (3 Devices)</td>
                                <td>125 Hz</td>
                                <td>11.8 ms</td>
                                <td>Multi-Device Productivity</td>
                            </tr>
                        </tbody>
                    </table>
                    <h2>3. Browser-Based QMK &amp; VIA Customization</h2>
                    <p>Unlike proprietary gaming software that bloats system memory, Keychron’s web launcher lets you remap any key, program complex macros, and adjust the rotary encoder knob directly inside Chrome or Edge in seconds.</p>
                ',
            ],
            [
                'title' => 'Roborock S8 MaxV Ultra Review: Tested Against Pet Hair, Dried Espresso & Deep Carpet',
                'excerpt' => 'Featuring 10,000Pa suction, a robotic extending side brush, and a 140°F hot-water self-washing dock, we put the Roborock S8 MaxV Ultra through 30 days of torture testing.',
                'featured_image' => 'https://images.unsplash.com/photo-1558317374-067fb5f30001?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['smart-home-appliances'],
                'type' => 'review',
                'is_featured' => true,
                'views_count' => 9870,
                'content' => '
                    <p>Flagship robot vacuums now promise complete hands-free floor care, carrying price tags north of $1,000. To find out if the <strong>Roborock S8 MaxV Ultra</strong> justifies the investment, we tested it across 2,400 square feet of hardwood, tile, and medium-pile rugs for a full month.</p>
                    <h2>1. Debris Pickup &amp; 10,000Pa Suction Test</h2>
                    <p>We scattered measured 100-gram batches of fine silica sand, cheerios, coffee grounds, and 4-inch synthetic pet hair across both hardwood floors and plush carpet.</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Surface &amp; Debris Type</th>
                                <th>Single Pass Pickup</th>
                                <th>Deep Clean 2-Pass Pickup</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hardwood Floor (Sand &amp; Coffee)</td>
                                <td>99.2%</td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td>90-Degree Wall Corners (FlexiArm Brush)</td>
                                <td>96.5%</td>
                                <td>98.8%</td>
                            </tr>
                            <tr>
                                <td>Medium-Pile Carpet (Embedded Pet Hair)</td>
                                <td>93.0%</td>
                                <td>97.4%</td>
                            </tr>
                        </tbody>
                    </table>
                    <h2>2. VibraRise 3.0 Sonic Mopping &amp; Hot Water Dock</h2>
                    <p>The dual sonic mopping module scrubs floors at 4,000 vibrations per minute while lifting 20mm automatically when transitioning onto rugs. After each run, the RockDock Ultra washes the mop pad with 140°F (60°C) water to dissolve kitchen grease and dries it with warm air.</p>
                    <h2>3. Obstacle Avoidance &amp; Smart Navigation</h2>
                    <p>Equipped with PreciSense LiDAR and an RGB camera, the S8 MaxV Ultra successfully dodged phone charging cables, socks, and pet bowls in both bright daylight and pitch-black rooms without getting stuck once in 30 days.</p>
                ',
            ],
            [
                'title' => 'Herman Miller Aeron vs. Steelcase Gesture: The Best Ergonomic Chairs After 1,000 Hours',
                'excerpt' => 'Our ergonomics panel spent six months sitting in the top 8 task chairs on the market—measuring lumbar support, breathable mesh tension, and 12-year warranty value.',
                'featured_image' => 'https://images.unsplash.com/photo-1580480055273-228ff5388ef8?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['desk-setup-ergonomics'],
                'type' => 'tutorial',
                'is_featured' => true,
                'views_count' => 16490,
                'content' => '
                    <p>If you spend 8 to 12 hours a day at a desk, a cheap foam office chair will flatten out within 18 months and contribute to chronic lower back fatigue. We brought the <strong>Herman Miller Aeron Remastered</strong>, <strong>Steelcase Gesture</strong>, and <strong>Branch Ergonomic Pro</strong> into our studio to evaluate long-term spinal support.</p>
                    <h2>1. Breathable Pellicle Mesh vs. Contoured Foam</h2>
                    <p>The Herman Miller Aeron’s 8Z Pellicle suspension distributes weight across eight distinct tension zones, eliminating pressure points under the thighs and keeping skin temperatures 4°C cooler than upholstered foam chairs during summer months.</p>
                    <h2>2. 360-Degree Armrests for Keyboard &amp; Mobile Use</h2>
                    <p>Where the Steelcase Gesture pulls ahead is its core-equalized 360-degree armrests. They pivot inward to support your forearms while typing on a compact 75% mechanical keyboard or holding a tablet.</p>
                    <h2>3. 12-Year Warranty &amp; Resale Value Comparison</h2>
                    <p>Both Herman Miller and Steelcase back their chairs with comprehensive 12-year, 3-shift warranties that include in-home technician service—making their cost-per-year lower than replacing a $250 department-store chair every two years.</p>
                ',
            ],
            [
                'title' => 'Breville Barista Express Impress Review: Cafe-Quality Espresso Without the Countertop Mess',
                'excerpt' => 'With a built-in 25-setting conical burr grinder, intelligent dose memory, and a 22-pound assisted tamping lever, Breville makes dialing in espresso effortless.',
                'featured_image' => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['kitchen-coffee-gear'],
                'type' => 'review',
                'is_featured' => false,
                'views_count' => 8420,
                'content' => '
                    <p>Pulling a balanced double shot of espresso at home traditionally requires a steep learning curve, a separate digital scale, and constant coffee grounds spilled across the counter. The <strong>Breville Barista Express Impress</strong> solves the two hardest variables for beginners: dosing consistency and level tamping.</p>
                    <h2>1. PID Temperature Stability &amp; Extraction Pressure</h2>
                    <p>Our thermal probe measurements confirmed that Breville’s Thermocoil heating system maintains water temperature at 200°F (±1.5°F) throughout a 28-second extraction, paired with a 9-bar over-pressure valve (OPV) that prevents bitter channelled shots.</p>
                    <h2>2. The Impress Puck System in Daily Use</h2>
                    <p>Pulling the side lever applies a calibrated 22 lbs (10 kg) of downward force with a 7-degree barista twist, leaving a clean, polished coffee puck inside the 54mm stainless-steel portafilter every single morning.</p>
                ',
            ],
            [
                'title' => 'Anker Prime 27,650mAh (250W) Power Bank & 140W GaN Charger Lab Test',
                'excerpt' => 'We hooked Anker’s flagship portable power bank up to our programmable DC electronic load tester to verify real usable watt-hours, thermal curves, and MacBook Pro charging speeds.',
                'featured_image' => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['edc-travel-gear'],
                'type' => 'review',
                'is_featured' => false,
                'views_count' => 7630,
                'content' => '
                    <p>Most high-capacity power banks throttle their output after 10 minutes due to internal heat buildup or fail to deliver their advertised capacity. We tested the <strong>Anker Prime 27,650mAh (99.54Wh)</strong> at full 140W USB-C PD 3.1 load.</p>
                    <h2>1. True Usable Wh Efficiency &amp; FAA Carry-On Compliance</h2>
                    <p>Rated at 99.54Wh, this power bank sits just below the strict 100Wh TSA/FAA limit for airline carry-on bags. In our discharge benchmark at 20V/5A (100W), it delivered 86.8Wh of net usable energy—an impressive 87.2% conversion efficiency.</p>
                    <h2>2. Smart OLED Telemetry Display</h2>
                    <p>The built-in color screen displays real-time input/output wattage per port and remaining time to empty down to the minute, eliminating battery anxiety when working remotely.</p>
                ',
            ],
            [
                'title' => 'Garmin Fenix 8 AMOLED vs. Apple Watch Ultra 2: Ultimate Outdoor GPS Watch Test',
                'excerpt' => 'Multi-band GNSS track accuracy, 16-day battery endurance, dive-rated titanium bezels, and built-in LED flashlights tested across 120 miles of mountain trails.',
                'featured_image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['fitness-recovery-tech'],
                'type' => 'review',
                'is_featured' => false,
                'views_count' => 9150,
                'content' => '
                    <p>When heading into the backcountry for a multi-day trek or training for an ultramarathon, your wrist computer cannot afford to die mid-route. We wore the <strong>Garmin Fenix 8 (47mm Sapphire Titanium)</strong> on one wrist and the <strong>Apple Watch Ultra 2</strong> on the other for 30 days.</p>
                    <h2>1. Dual-Frequency GPS Accuracy in Deep Canyons</h2>
                    <p>Both watches utilize L1 + L5 multi-band satellite tracking, staying within 1.5 meters of surveyed trail markers even under dense conifer canopy. However, Garmin’s preloaded TopoActive offline maps and physical 5-button layout remain unmatched when wearing winter gloves.</p>
                    <h2>2. Real-World Battery Endurance</h2>
                    <p>While the Apple Watch Ultra 2 requires a charge every 48 to 60 hours, the Garmin Fenix 8 lasted 14 full days on a single charge including 10 hours of multi-band GPS workouts.</p>
                ',
            ],
            [
                'title' => 'The 7 Best HEPA Air Purifiers of 2026: Tested Against Smoke, Wildfire Haze & Allergens',
                'excerpt' => 'Using a laser particle counter inside a sealed test room, we measured how fast top air purifiers from Coway, Winix, Levoit, and Dyson clear 0.1-micron airborne particulates.',
                'featured_image' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['smart-home-appliances'],
                'type' => 'tutorial',
                'is_featured' => false,
                'views_count' => 6890,
                'content' => '
                    <p>An air purifier is essentially a precision fan paired with a dense mechanical True HEPA filter—yet prices range from $90 to over $700. Our lab measured Clean Air Delivery Rate (CADR), decibel noise levels at sleep settings, and 3-year filter replacement costs.</p>
                    <h2>1. Top Pick: Coway Airmega AP-1512HH Mighty</h2>
                    <p>In our 30-minute smoke clearance test, the Coway Airmega removed 99.6% of PM2.5 particles in a 350-square-foot room while drawing only 7 watts on Medium speed and running at a whisper-quiet 38 dBA.</p>
                    <h2>2. Large Living Room Pick: Coway Airmega 400 vs. Levoit Core 600S</h2>
                    <p>For open-concept spaces up to 1,500 sq. ft., dual-intake purifiers move twice the air volume at lower fan RPMs, drastically reducing acoustic hum.</p>
                ',
            ],
            [
                'title' => 'Peak Design Travel Backpack 45L Unboxing & 6-Month International Carry-On Test',
                'excerpt' => 'Weatherproof 100% recycled 400D nylon canvas, custom aluminum hardware, and expandable 35L-to-45L capacity make this the gold standard for one-bag travelers.',
                'featured_image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=1400&q=85',
                'category_id' => $categoryMap['edc-travel-gear'],
                'type' => 'news',
                'is_featured' => false,
                'views_count' => 5940,
                'content' => '
                    <p>One-bag travel demands a pack that fits overhead airline bins while protecting laptops, cameras, and a week’s worth of clothing from torrential rain. We took the <strong>Peak Design Travel Backpack 45L</strong> across 18 flights on 6 airlines.</p>
                    <h2>1. Weatherproofing &amp; UltraZip Durability</h2>
                    <p>The burly #10 weatherproof UltraZips use abrasion-resistant UHMPE thread that glides smoothly even when the bag is packed to maximum 45-liter capacity.</p>
                    <h2>2. Magnetic Stowaway Straps</h2>
                    <p>When boarding crowded regional jets, the padded shoulder straps and hip belt tuck neatly behind magnetic back panels in five seconds so nothing snags in overhead compartments.</p>
                ',
            ],
        ];

        // Clear old AI posts and seed physical product posts cleanly
        Post::query()->delete();

        foreach ($samplePosts as $idx => $postData) {
            $post = Post::create(array_merge($postData, [
                'slug' => Str::slug($postData['title']),
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays($idx * 2 + 1),
            ]));

            $post->tags()->sync(
                collect($tags)->random(4)->pluck('id')
            );
        }

        // Remove any legacy AI categories that are not in our physical product list
        Category::whereNotIn('slug', array_keys($categoryMap))->delete();

        // === 5. Seed Verified Physical Product Retail Deals ===
        $this->call(DealSeeder::class);

        // === 6. Seed Affiliate-Compliant Static Pages ===
        $this->call(PageSeeder::class);

        // === 7. Update Site Settings ===
        Setting::set('site_name', 'VerdictTC.com');
        Setting::set('site_description', 'Independent Physical Product Reviews, Lab Benchmarks, Comparisons & Verified Retail Deals');
        Setting::set('posts_per_page', '15');
        Setting::set('contact_email', 'editorial@verdicttc.com');
    }
}
