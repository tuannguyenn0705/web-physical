<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Hiển thị trang tĩnh
     */
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $allPages = Page::active()->orderBy('id')->get();

        return view('pages.show', compact('page', 'allPages'));
    }
}
