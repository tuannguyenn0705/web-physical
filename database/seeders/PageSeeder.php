<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Seed essential trust, testing methodology, legal, and FTC/Amazon affiliate compliance pages.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'about-us',
                'title' => 'About VERDICT.LAB & How We Test',
                'meta_title' => 'About Us & Testing Methodology - VERDICT.LAB',
                'meta_description' => 'Learn how VERDICT.LAB independently purchases, stress-tests, and benchmarks consumer hardware, smart home appliances, and everyday gear.',
                'is_active' => true,
                'content' => '
                    <p class="lead"><strong>VERDICT.LAB</strong> is an independent consumer hardware publication and product testing laboratory dedicated to helping readers buy better, longer-lasting physical gear.</p>
                    <h2>Our Editorial &amp; Testing Philosophy</h2>
                    <p>Every year, thousands of headphones, mechanical keyboards, robot vacuums, espresso machines, and ergonomic chairs hit the market wrapped in exaggerated marketing claims. Our engineering and editorial team cuts through the hype by purchasing retail units and putting them through repeatable, quantitative stress tests.</p>
                    <h2>How We Test Physical Products</h2>
                    <ul>
                        <li><strong>Retail Unit Purchasing:</strong> We purchase our test units from the same authorized retailers our readers use—including Amazon, Best Buy, Walmart, and B&amp;H Photo—so manufacturers cannot hand-pick "golden samples."</li>
                        <li><strong>Standardized Laboratory Telemetry:</strong> From acoustic isolation chambers and LDAT key-latency sensors to thermal imaging cameras and laser particle counters, we log objective data before writing a single word.</li>
                        <li><strong>Long-Term Durability Tracking:</strong> A product that works on day one might fail on day ninety. We live with our top picks in real homes and offices for months to monitor battery degradation, hinge wear, and warranty support.</li>
                        <li><strong>100% Editorial Independence:</strong> Brands cannot pay to be featured, nor can they preview or alter our scores before publication.</li>
                    </ul>
                    <h2>Corrections &amp; Product Submissions</h2>
                    <p>We continuously update our buying guides as new hardware revisions launch or street prices shift. To reach our laboratory team or inquire about our testing protocols, contact <a href="mailto:editorial@verdictlab.com">editorial@verdictlab.com</a>.</p>
                ',
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact & Brand Partnerships',
                'meta_title' => 'Contact Us & Partnerships - VERDICT.LAB',
                'meta_description' => 'Contact the VERDICT.LAB editorial lab, deals desk, and commerce partnerships team.',
                'is_active' => true,
                'content' => '
                    <p class="lead">Have a question about one of our hardware benchmarks, spotted a live price drop, or want to discuss an affiliate commerce partnership? Reach out to the appropriate desk below.</p>
                    <h2>Direct Department Contacts</h2>
                    <ul>
                        <li><strong>Editorial &amp; Testing Lab Inquiries:</strong> <a href="mailto:editorial@verdictlab.com">editorial@verdictlab.com</a></li>
                        <li><strong>Deals Desk &amp; Retail Partnerships:</strong> <a href="mailto:deals@verdictlab.com">deals@verdictlab.com</a></li>
                    </ul>
                    <h2>U.S. Testing Lab &amp; Headquarters</h2>
                    <p><strong>VERDICT.LAB LLC</strong><br>
                    1200 17th Street NW, Suite 500<br>
                    Washington, D.C. 20036<br>
                    United States</p>
                    <h2>Information for Retailers &amp; Affiliate Networks</h2>
                    <p>VERDICT.LAB partners with leading global e-commerce retailers and affiliate networks (including Amazon Associates, Impact, CJ Affiliate, Rakuten Advertising, ShareASale, Awin, and Best Buy) to provide real-time stock verification and promotional codes for our readers.</p>
                    <p>Please note: Submitting a physical product or affiliate offer does not guarantee editorial coverage or a favorable rating. All hardware must pass our standardized laboratory benchmark suite.</p>
                ',
            ],
            [
                'slug' => 'affiliate-disclosure',
                'title' => 'FTC & Amazon Affiliate Disclosure',
                'meta_title' => 'FTC Affiliate Disclosure - VERDICT.LAB',
                'meta_description' => 'Full transparency regarding how VERDICT.LAB uses retail affiliate links, price comparison widgets, and partner commissions in compliance with FTC guidelines.',
                'is_active' => true,
                'content' => '
                    <p class="lead">At <strong>VERDICT.LAB</strong>, reader trust and testing integrity come first. In full compliance with the Federal Trade Commission (FTC) 16 CFR Part 255 Endorsement Guides, please note that VERDICT.LAB is a reader-supported publication and uses affiliate links to authorized retail merchants.</p>
                    <h2>Amazon Associates Disclosure</h2>
                    <p><strong>As an Amazon Associate, VERDICT.LAB earns from qualifying purchases.</strong> Amazon and the Amazon logo are trademarks of Amazon.com, Inc. or its affiliates.</p>
                    <h2>How Retail Affiliate Links Work</h2>
                    <p>When you click a "Buy on Amazon", "Check Best Buy", or "Claim Deal" button in our buying guides and subsequently purchase a product from that retailer, we may earn a small referral commission from the merchant.</p>
                    <ul>
                        <li><strong>Never Any Extra Cost to You:</strong> Clicking an affiliate link never increases the retail price you pay. In many cases, our Deals Desk negotiates exclusive promo codes that lower your checkout total.</li>
                        <li><strong>Strict Separation of Editorial &amp; Commerce:</strong> Our laboratory engineers and writers evaluate products and assign scores before our commerce team attaches retail links. Writers do not know which retailers offer higher commission rates.</li>
                        <li><strong>Customer Returns Cancel Commissions:</strong> If you buy a product we recommend and return it because it did not meet your expectations, we make nothing. This aligns our financial incentive directly with recommending reliable, high-quality physical products.</li>
                    </ul>
                    <p>For questions regarding our ethics policy or affiliate disclosures, contact <a href="mailto:editorial@verdictlab.com">editorial@verdictlab.com</a>.</p>
                ',
            ],
            [
                'slug' => 'privacy-policy',
                'title' => 'Privacy Policy',
                'meta_title' => 'Privacy Policy - VERDICT.LAB',
                'meta_description' => 'Read the VERDICT.LAB Privacy Policy covering data collection, cookies, price alert subscriptions, and third-party retail affiliate tracking.',
                'is_active' => true,
                'content' => '
                    <p class="lead">This Privacy Policy explains how <strong>VERDICT.LAB LLC</strong> collects, uses, and protects information when you browse our hardware reviews, comparison tables, and deal alerts.</p>
                    <h2>1. Information We Collect</h2>
                    <ul>
                        <li><strong>Voluntary Information:</strong> When you subscribe to our Price Drop Alerts newsletter or email our team, we collect your email address solely to deliver the requested updates.</li>
                        <li><strong>Anonymized Analytics:</strong> We collect standard non-identifying browser telemetry (such as device type, page views, and time on page) to optimize website speed and layout usability.</li>
                    </ul>
                    <h2>2. Cookies &amp; Retail Affiliate Attribution</h2>
                    <p>When you click an outbound link to a retail merchant (such as Amazon, Best Buy, Walmart, B&amp;H Photo, or a brand store via Impact, CJ Affiliate, Rakuten, or ShareASale), the destination merchant may place a temporary referral cookie in your browser solely to attribute the purchase and apply any promotional discount.</p>
                    <h2>3. Zero Data Selling Guarantee</h2>
                    <p>We never sell, rent, or trade subscriber email addresses to third-party advertisers or data brokers. You can unsubscribe from our newsletter with a single click at the bottom of any email.</p>
                    <h2>4. Your Rights Under GDPR &amp; CCPA</h2>
                    <p>You may request access to or permanent deletion of your personal data at any time by emailing <a href="mailto:editorial@verdictlab.com">editorial@verdictlab.com</a>.</p>
                ',
            ],
            [
                'slug' => 'terms-of-service',
                'title' => 'Terms of Service',
                'meta_title' => 'Terms of Service - VERDICT.LAB',
                'meta_description' => 'Terms and conditions governing your use of VERDICT.LAB product reviews, lab comparisons, and retail deal links.',
                'is_active' => true,
                'content' => '
                    <p class="lead">By accessing and using <strong>VERDICT.LAB</strong>, you agree to comply with the following Terms of Service.</p>
                    <h2>1. Intellectual Property &amp; Lab Data</h2>
                    <p>All original hardware reviews, benchmark tables, photography, and buying guides published on VERDICT.LAB are the copyrighted property of VERDICT.LAB LLC. Brief quotations with clear attribution and a direct hyperlink back to our source page are permitted.</p>
                    <h2>2. Retail Pricing &amp; Inventory Disclaimer</h2>
                    <p>Product prices, stock availability, and promotional coupon codes on third-party retail platforms (including Amazon, Best Buy, and Walmart) change frequently. While our price tracker updates regularly, the final price displayed on the merchant’s checkout page at the time of purchase governs the transaction.</p>
                    <h2>3. Warranty &amp; Merchant Fulfillment</h2>
                    <p>VERDICT.LAB is an independent review publication and does not ship physical merchandise directly. All product warranties, shipping timelines, and return policies are fulfilled by the respective manufacturer or authorized retailer.</p>
                ',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}
