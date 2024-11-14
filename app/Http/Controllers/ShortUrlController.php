<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ShortUrl;


class ShortUrlController extends Controller
{
    public function index()
    {
        return view('welcome'); // Return the homepage view
    }

    public function shorten(Request $request)
    {
        // Validate the input
        $request->validate([
            'original_url' => 'required|url',
            'custom_short_code' => 'nullable|string|max:10|unique:short_urls,short_url', // Ensure uniqueness and max length
        ]);
    
        // Sanitize the input URL
        $originalUrl = filter_var($request->input('original_url'), FILTER_SANITIZE_URL);
    
        // Check if the sanitized URL is valid
        if (!filter_var($originalUrl, FILTER_VALIDATE_URL)) {
            return redirect()->back()->withErrors(['original_url' => 'The provided URL is not valid.']);
        }
    
        $customShortCode = $request->input('custom_short_code');
    
        // Use the custom short code if provided, otherwise generate a random one
        if (empty($customShortCode)) {
            $shortUrl = Str::random(6); // Generate a random short code
        } else {
            $shortUrl = $customShortCode;
        }
    
        // Store the URL in the database with the user_id
        ShortUrl::create([
            'original_url' => $originalUrl,
            'short_url' => $shortUrl,
            'user_id' => auth()->id(), // Save the user ID
        ]);
    
        return redirect()->back()->with('shortened_url', url($shortUrl));
    }

    public function redirect($shortUrl)
    {
        $url = ShortUrl::where('short_url', $shortUrl)->firstOrFail();

        $url->increment('click_count');

        return redirect($url->original_url);
    }

    public function dashboard()
    {
        $urls = ShortUrl::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get(); // Get URLs for the authenticated user
        return view('dashboard', compact('urls')); // Pass the URLs to the dashboard view
    }

    public function edit($id)
    {
        $url = ShortUrl::findOrFail($id);
        return view('url.edit', compact('url')); // Create a view for editing the URL
    }

    public function remove($id)
    {
        $url = ShortUrl::findOrFail($id);
        $url->delete(); // Delete the URL
        return redirect()->back()->with('status', 'URL removed successfully.'); // Redirect back with a success message
    }

    public function update(Request $request)
    {
        // Validate the input
        $request->validate([
            'custom_short_code' => 'string|max:10|unique:short_urls,short_url,' . $request->input('id'), // Ensure uniqueness and max length
        ]);

        // Find the URL by ID
        $url = ShortUrl::findOrFail($request->input('id'));

        // Update the custom short code if provided
        if ($request->filled('custom_short_code')) {
            $url->short_url = $request->input('custom_short_code');
        }

        // Save the changes
        $url->save();

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('status', 'Shortened URL updated successfully.');
    }
}
