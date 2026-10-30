<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed dữ liệu mẫu cho AI Hub Insider
     */
    public function run(): void
    {
        // === Tạo Admin User ===
        $admin = User::firstOrCreate(
            ['email' => 'adminaihub@gmail.com'],
            [
                'name' => 'Admin AI Hub',
                'password' => bcrypt('Tuan2006@'),
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@aihubinsider.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // === Create Categories ===
        $categories = [
            ['name' => 'ChatGPT & OpenAI', 'slug' => 'chatgpt-openai', 'description' => 'Latest news, updates, and guides on ChatGPT, GPT-5, and OpenAI', 'order' => 1],
            ['name' => 'Google AI', 'slug' => 'google-ai', 'description' => 'Gemini, Google DeepMind, and Google AI ecosystem breakthroughs', 'order' => 2],
            ['name' => 'AI Tools', 'slug' => 'ai-tools', 'description' => 'In-depth reviews and comparisons of top AI productivity tools', 'order' => 3],
            ['name' => 'AI for Coding', 'slug' => 'ai-coding', 'description' => 'AI coding assistants: Cursor, GitHub Copilot, Claude Code, and more', 'order' => 4],
            ['name' => 'AI Art & Design', 'slug' => 'ai-art-design', 'description' => 'Midjourney, DALL-E, Stable Diffusion, and generative design tools', 'order' => 5],
            ['name' => 'AI News', 'slug' => 'ai-news', 'description' => 'Breaking artificial intelligence industry news and research', 'order' => 6],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // === Create Tags ===
        $tagNames = ['ChatGPT', 'GPT-4', 'Gemini', 'Claude', 'Midjourney', 'Stable Diffusion', 'LLM',
            'Machine Learning', 'Deep Learning', 'NLP', 'Computer Vision', 'Prompt Engineering',
            'AI Agent', 'RAG', 'Fine-tuning', 'Open Source'];

        $tags = [];
        foreach ($tagNames as $name) {
            $tags[] = Tag::create(['name' => $name, 'slug' => Str::slug($name)]);
        }

        // === Create Sample Posts ===
        $samplePosts = [
            [
                'title' => 'GPT-5 Officially Launches: Next-Gen Reasoning and Multimodal Breakthroughs',
                'excerpt' => 'OpenAI has officially unveiled GPT-5, featuring major leaps in logical reasoning, native multimodal processing, and 3x faster response speeds.',
                'content' => '<p>OpenAI has officially launched GPT-5, the latest generation of its flagship large language model.</p><h2>Key Highlights</h2><p>GPT-5 brings significant improvements over its predecessor across coding, math, and real-time multimodal tasks.</p><ul><li>Advanced multi-step logical reasoning</li><li>Native multimodal processing across text, image, and audio</li><li>3x faster token generation speed</li><li>Expanded 1-million-token context window</li></ul>',
                'category_id' => 1, 'type' => 'news', 'is_featured' => true,
            ],
            [
                'title' => 'Gemini 2.0 In-Depth Review: A True Rival to GPT-5',
                'excerpt' => 'Google DeepMind releases Gemini 2.0 with state-of-the-art benchmark scores across coding and multimodal tasks. Here is our full review.',
                'content' => '<p>Gemini 2.0 represents a massive leap forward for Google in the AI race.</p><h2>Benchmark Performance</h2><p>Gemini 2.0 achieves top-tier scores on MMLU, HumanEval, and MATH benchmarks.</p><h2>New Capabilities</h2><p>Native long-video understanding, agentic tool use, and complex code generation.</p>',
                'category_id' => 2, 'type' => 'review', 'is_featured' => true,
            ],
            [
                'title' => 'Top 10 Free AI Productivity Tools Every Professional Should Use in 2026',
                'excerpt' => 'Discover the 10 best free AI tools that dramatically boost daily workflow efficiency, writing, and presentation design.',
                'content' => '<p>In 2026, a wide range of powerful free AI tools can save you hours every week.</p><h2>1. ChatGPT Free Tier</h2><p>OpenAI’s free tier remains one of the most versatile daily assistants.</p><h2>2. Gamma AI</h2><p>Generate polished presentation decks and documents in minutes.</p>',
                'category_id' => 3, 'type' => 'tutorial', 'is_featured' => true,
            ],
            [
                'title' => 'Cursor AI Review: The Smartest AI-First Code Editor for Developers',
                'excerpt' => 'A comprehensive review of Cursor AI — the AI-powered IDE helping software engineers write and refactor code up to 10x faster.',
                'content' => '<p>Cursor AI has fundamentally transformed how modern developers write and maintain code.</p><h2>Standout Features</h2><p>Predictive Tab completion, multi-file Composer edits, and deep codebase indexing.</p>',
                'category_id' => 4, 'type' => 'review', 'is_featured' => false,
            ],
            [
                'title' => 'Prompt Engineering Masterclass: From Fundamentals to Advanced Techniques',
                'excerpt' => 'Learn how to craft high-precision prompts for ChatGPT, Claude, and Gemini to get consistent, expert-level outputs.',
                'content' => '<p>Prompt Engineering is one of the highest-leverage skills when working with modern LLMs.</p><h2>Chain of Thought</h2><p>Guide the model to reason step by step before producing its final answer.</p><h2>Few-Shot Prompting</h2><p>Provide concrete input-output examples so the AI matches your exact format and tone.</p>',
                'category_id' => 3, 'type' => 'tutorial', 'is_featured' => true,
            ],
            [
                'title' => 'Midjourney V7 Released: Photorealistic AI Image Generation Reaches New Heights',
                'excerpt' => 'Midjourney V7 elevates AI art generation with stunning lighting accuracy, natural hands, and sharp text rendering.',
                'content' => '<p>Midjourney V7 marks a major milestone in generative visual art.</p><h2>Visual Quality Upgrades</h2><p>Generated images are now virtually indistinguishable from studio photography.</p>',
                'category_id' => 5, 'type' => 'news', 'is_featured' => true,
            ],
            [
                'title' => 'What Are AI Agents? The Future of Autonomous Workflow Automation',
                'excerpt' => 'Explore how autonomous AI Agents are reshaping software engineering, customer support, and enterprise operations in 2026.',
                'content' => '<p>An AI Agent is an autonomous system capable of planning, reasoning, and executing multi-step actions using external tools.</p><h2>Core Types of AI Agents</h2><p>Reactive agents, tool-augmented planners, multi-agent swarms, and self-improving workflows.</p>',
                'category_id' => 6, 'type' => 'news', 'is_featured' => false,
            ],
            [
                'title' => 'Claude 4 vs GPT-5 Comparison: Which Frontier AI Model Wins in 2026?',
                'excerpt' => 'Head-to-head comparison of the two most powerful AI models available today: Anthropic’s Claude 4 and OpenAI’s GPT-5.',
                'content' => '<p>The frontier AI race in 2026 is closer than ever before.</p><h2>Coding & Software Engineering</h2><p>Claude 4 leads on real-world SWE-bench software engineering tasks.</p><h2>Complex Reasoning</h2><p>GPT-5 holds an edge in abstract mathematics and multimodal synthesis.</p>',
                'category_id' => 6, 'type' => 'review', 'is_featured' => false,
            ],
        ];

        foreach ($samplePosts as $postData) {
            $post = Post::create(array_merge($postData, [
                'slug' => Str::slug($postData['title']),
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(rand(0, 30)),
                'views_count' => rand(100, 5000),
            ]));

            // Attach random tags
            $post->tags()->attach(
                collect($tags)->random(rand(2, 5))->pluck('id')
            );
        }

        // === Create Sample Deals ===
        $this->call(DealSeeder::class);

        // === Create Essential Legal & Trust Static Pages ===
        $this->call(PageSeeder::class);

        // === Create Settings ===
        Setting::set('site_name', 'AI Hub Insider');
        Setting::set('site_description', 'Latest AI news, tool reviews, tutorials, and exclusive AI deals');
        Setting::set('posts_per_page', '15');
        Setting::set('contact_email', 'aihubinsider@gmail.com');
    }
}
