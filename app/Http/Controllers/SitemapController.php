<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML Sitemap for search engines and affiliate verification crawlers.
     */
    public function index(): Response
    {
        $posts = Post::published()->latest('updated_at')->get();
        $categories = Category::active()->get();
        $pages = Page::active()->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        $staticUrls = [
            ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => route('posts.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('deals.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
        ];

        foreach ($staticUrls as $item) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e($item['loc']).'</loc>'."\n";
            $xml .= '    <changefreq>'.$item['changefreq'].'</changefreq>'."\n";
            $xml .= '    <priority>'.$item['priority'].'</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        foreach ($pages as $page) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e(route('pages.show', $page->slug)).'</loc>'."\n";
            $xml .= '    <lastmod>'.$page->updated_at->toAtomString().'</lastmod>'."\n";
            $xml .= '    <changefreq>monthly</changefreq>'."\n";
            $xml .= '    <priority>0.7</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        foreach ($categories as $category) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e(route('categories.show', $category->slug)).'</loc>'."\n";
            $xml .= '    <changefreq>weekly</changefreq>'."\n";
            $xml .= '    <priority>0.8</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        foreach ($posts as $post) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.e(route('posts.show', $post->slug)).'</loc>'."\n";
            $xml .= '    <lastmod>'.($post->updated_at ?? $post->created_at)->toAtomString().'</lastmod>'."\n";
            $xml .= '    <changefreq>weekly</changefreq>'."\n";
            $xml .= '    <priority>0.8</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
