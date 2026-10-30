<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Seed essential trust, legal, and affiliate compliance pages.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'about-us',
                'title' => 'About AI Hub Insider',
                'meta_title' => 'About Us - AI Hub Insider',
                'meta_description' => 'Learn about AI Hub Insider, our editorial mission, independent AI software testing methodology, and global team of analysts.',
                'is_active' => true,
                'content' => '
                    <p class="lead"><strong>AI Hub Insider</strong> is an independent digital publication dedicated to helping professionals, developers, and creators navigate the rapidly evolving artificial intelligence ecosystem.</p>
                    <h2>Our Editorial Mission</h2>
                    <p>Every week, hundreds of new AI tools, large language models, and automation platforms launch worldwide. Our mission is to cut through the marketing noise with rigorous, hands-on testing, real-world benchmarks, and practical tutorials you can apply immediately.</p>
                    <h2>How We Test & Review AI Software</h2>
                    <ul>
                        <li><strong>Hands-On Evaluation:</strong> We test every AI tool in real production workflows—measuring output accuracy, latency, pricing value, and ease of integration.</li>
                        <li><strong>Unbiased Ratings:</strong> Our editorial scores are determined solely by our research and testing team. Commercial partnerships never influence our review verdicts.</li>
                        <li><strong>Verified Deals & Discounts:</strong> Our partnerships team works directly with leading AI software vendors to negotiate exclusive promo codes and verified discounts for our readers.</li>
                    </ul>
                    <h2>Editorial Standards & Corrections</h2>
                    <p>We update our reviews and comparisons continuously as models evolve (such as GPT-5, Claude 4, Gemini 2.0, and Cursor). If you spot an outdated metric or broken offer link, please reach out to our editorial desk at <a href="mailto:aihubinsider@gmail.com">aihubinsider@gmail.com</a>.</p>
                ',
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact & Partnerships',
                'meta_title' => 'Contact Us & Advertise - AI Hub Insider',
                'meta_description' => 'Get in touch with the AI Hub Insider editorial and partnerships team for tool submissions, affiliate deals, and media inquiries.',
                'is_active' => true,
                'content' => '
                    <p class="lead">Whether you want to submit an AI tool for editorial review, share an exclusive promo code for our Deals directory, or discuss partnership opportunities, our team would love to hear from you.</p>
                    <h2>Direct Contact Channel</h2>
                    <ul>
                        <li><strong>Editorial, Press & Partnerships:</strong> <a href="mailto:aihubinsider@gmail.com">aihubinsider@gmail.com</a></li>
                    </ul>
                    <h2>U.S. Headquarters & Operations</h2>
                    <p><strong>AI Hub Insider LLC</strong><br>
                    1200 17th Street NW, Suite 500<br>
                    Washington, D.C. 20036<br>
                    United States</p>
                    <h2>Submit an AI Tool or Exclusive Deal</h2>
                    <p>If you represent a software vendor or AI startup and would like your product reviewed or featured in our <a href="/deals">AI Deals Directory</a>, please include:</p>
                    <ul>
                        <li>Your product name, official website URL, and primary use case.</li>
                        <li>Details of any discount, promo code, or extended free trial available for AI Hub Insider readers.</li>
                        <li>Your affiliate program details (PartnerStack, Impact, CJ, FirstPromoter, or custom tracking link).</li>
                    </ul>
                    <p>Our editorial and partnerships team typically responds within 24–48 business hours.</p>
                ',
            ],
            [
                'slug' => 'affiliate-disclosure',
                'title' => 'Affiliate Disclosure',
                'meta_title' => 'FTC Affiliate Disclosure - AI Hub Insider',
                'meta_description' => 'Full transparency regarding how AI Hub Insider uses affiliate links, promo codes, and partner commissions in compliance with FTC guidelines.',
                'is_active' => true,
                'content' => '
                    <p class="lead">At <strong>AI Hub Insider</strong>, transparency and reader trust are our highest priorities. In compliance with the Federal Trade Commission (FTC) guidelines, please assume that any external link to a software product, AI tool, or deal on this website may be an affiliate link.</p>
                    <h2>How Affiliate Links Work</h2>
                    <p>When you click on a "Shop Now" button, promo link, or product recommendation on AI Hub Insider and subsequently make a purchase on the vendor’s website, we may receive a referral commission from that vendor.</p>
                    <ul>
                        <li><strong>Zero Extra Cost to You:</strong> Clicking an affiliate link never increases the price you pay. In most cases, our partner links apply an exclusive discount or extended trial that lowers your cost.</li>
                        <li><strong>Editorial Independence:</strong> Compensation from affiliate programs never dictates which products we review or the scores we assign. We regularly recommend free and open-source AI tools alongside commercial software.</li>
                    </ul>
                    <h2>Why We Use Affiliate Partnerships</h2>
                    <p>Running in-depth benchmark tests on frontier AI models, maintaining server infrastructure, and publishing free step-by-step tutorials require significant resources. Affiliate commissions allow us to keep all of our articles, guides, and benchmarks 100% free for readers worldwide without intrusive pop-up advertisements.</p>
                    <p>If you have any questions regarding this disclosure or our partnership policies, please contact us at <a href="mailto:aihubinsider@gmail.com">aihubinsider@gmail.com</a>.</p>
                ',
            ],
            [
                'slug' => 'privacy-policy',
                'title' => 'Privacy Policy',
                'meta_title' => 'Privacy Policy - AI Hub Insider',
                'meta_description' => 'Read the AI Hub Insider Privacy Policy covering data collection, cookies, newsletter subscriptions, and third-party affiliate links.',
                'is_active' => true,
                'content' => '
                    <p class="lead">This Privacy Policy explains how <strong>AI Hub Insider</strong> collects, uses, and safeguards information when you visit our website.</p>
                    <h2>1. Information We Collect</h2>
                    <ul>
                        <li><strong>Voluntary Information:</strong> When you subscribe to our newsletter or contact our team, we collect your email address and optional display name.</li>
                        <li><strong>Usage & Analytics Data:</strong> We collect anonymized log data such as browser type, referring pages, and time spent on articles to improve site performance and content quality.</li>
                    </ul>
                    <h2>2. Cookies & Affiliate Tracking</h2>
                    <p>When you click on an external deal or partner link on AI Hub Insider, the destination merchant or affiliate network (such as Impact, PartnerStack, or CJ Affiliate) may place a standard tracking cookie in your browser solely to attribute the referral and apply your discount.</p>
                    <h2>3. How We Use Your Information</h2>
                    <p>We never sell, rent, or trade your personal email address to third-party data brokers. Newsletter emails are used strictly to send our curated AI news briefings and verified software deals, and you may unsubscribe with a single click at any time.</p>
                    <h2>4. Your Privacy Rights (GDPR & CCPA)</h2>
                    <p>You have the right to request access to, correction of, or deletion of any personal data we hold about you. To exercise these rights, email <a href="mailto:aihubinsider@gmail.com">aihubinsider@gmail.com</a>.</p>
                ',
            ],
            [
                'slug' => 'terms-of-service',
                'title' => 'Terms of Service',
                'meta_title' => 'Terms of Service - AI Hub Insider',
                'meta_description' => 'Terms and conditions governing your use of the AI Hub Insider website, reviews, tutorials, and third-party software deals.',
                'is_active' => true,
                'content' => '
                    <p class="lead">By accessing and using <strong>AI Hub Insider</strong>, you agree to comply with and be bound by the following Terms of Service.</p>
                    <h2>1. Intellectual Property</h2>
                    <p>All original articles, reviews, tutorials, graphics, and code examples published on AI Hub Insider are the property of AI Hub Insider unless otherwise noted. You may quote brief excerpts with clear attribution and a direct link back to the original article.</p>
                    <h2>2. Third-Party Software & Deals Disclaimer</h2>
                    <p>AI Hub Insider curates discounts, promo codes, and links to third-party AI software providers. Because software pricing and promotional terms are controlled by external vendors, we cannot guarantee that a third-party offer or coupon code will remain active indefinitely. All purchases made on external websites are governed by that vendor’s own terms and refund policies.</p>
                    <h2>3. No Professional Advice</h2>
                    <p>Content on AI Hub Insider is provided for informational and educational purposes only. Always verify critical technical or business configurations before deploying AI tools in production environments.</p>
                    <h2>4. User Conduct</h2>
                    <p>You agree to use our website for lawful purposes only and in a way that does not infringe upon the rights or restrict the use and enjoyment of this site by any third party.</p>
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
