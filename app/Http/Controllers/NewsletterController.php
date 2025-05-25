<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index() {

        $newsletters = Newsletter::all();
        return view('newsletters.index', compact('newsletters'));
    }

    public function mySubscriptions()
    {
        $subscriptions = auth()->user()->subscriptions;
        return view('newsletters.my-subscriptions', compact('subscriptions'));
    }

    public function mySubscribers()
    {
        $newsletter = auth()->user()->newsletters()->first();

        if (!$newsletter) {
            return redirect()->back()->with('error', 'You do not own a newsletter.');
        }

        $subscribers = $newsletter->subscribers;
        return view('newsletters.my-subscribers', compact('subscribers'));
    }

    public function editMyNewsletter()
    {
        $newsletter = auth()->user()->newsletters()->first();
        
        if (!$newsletter) {
            // Create default newsletter for the customer if they don't have one
            $newsletter = new Newsletter([
                'name' => auth()->user()->name . "'s Newsletter",
                'description' => 'My newsletter description',
            ]);
            
            $newsletter->user_id = auth()->id();
            $newsletter->save();
        }
        
        return view('newsletters.edit-my-newsletter', compact('newsletter'));
    }

    public function updateMyNewsletter(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        $newsletter = auth()->user()->newsletters()->first();
        
        if (!$newsletter) {
            return redirect()->back()->with('error', 'You do not own a newsletter.');
        }
        
        $newsletter->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        
        return redirect()->route('newsletter.my.edit')->with('success', 'Newsletter updated successfully!');
    }

    /**
     * Display the specified newsletter.
     *
     * @param Newsletter $newsletter
     * @return \Illuminate\View\View
     */
    public function show(Newsletter $newsletter)
    {
        $isSubscribed = false;
        
        if (auth()->check()) {
            $isSubscribed = auth()->user()->subscriptions->contains($newsletter->id);
        }
        
        return view('newsletters.show', compact('newsletter', 'isSubscribed'));
    }

    /**
     * Subscribe to a newsletter.
     *
     * @param Newsletter $newsletter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Newsletter $newsletter)
    {
        $user = auth()->user();
        
        // Check if the user is already subscribed
        if (!$user->subscriptions->contains($newsletter->id)) {
            $user->subscriptions()->attach($newsletter->id);
            return redirect()->back()->with('success', 'Successfully subscribed to the newsletter!');
        }
        
        return redirect()->back()->with('info', 'You are already subscribed to this newsletter.');
    }

    /**
     * Unsubscribe from a newsletter.
     *
     * @param Newsletter $newsletter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe(Newsletter $newsletter)
    {
        $user = auth()->user();
        
        // Check if the user is subscribed
        if ($user->subscriptions->contains($newsletter->id)) {
            $user->subscriptions()->detach($newsletter->id);
            return redirect()->back()->with('success', 'Successfully unsubscribed from the newsletter.');
        }
        
        return redirect()->back()->with('info', 'You are not subscribed to this newsletter.');
    }
}
