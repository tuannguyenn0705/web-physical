<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Subscribe a reader email to the newsletter and deal alerts.
     */
    public function subscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        Subscriber::updateOrCreate(
            ['email' => strtolower(trim($validated['email']))],
            ['is_active' => true]
        );

        return back()->with('success', 'Thank you for subscribing! You will receive our weekly AI briefing and verified software deals.');
    }
}
