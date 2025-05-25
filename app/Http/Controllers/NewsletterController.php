<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request) {
        $query = Newsletter::with('user');
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $newsletters = $query->get();
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
            $newsletter = new Newsletter([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
            ]);
            $newsletter->save();
            
            return redirect()->route('newsletter.my.edit')->with('success', 'Newsletter created successfully!');
        }
        
        $newsletter->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        
        return redirect()->route('newsletter.my.edit')->with('success', 'Newsletter updated successfully!');
    }

    public function create()
    {
        return view('newsletters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        $newsletter = new Newsletter([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);
        
        $newsletter->save();
        
        return redirect()->route('dashboard')->with('success', 'Newsletter created successfully!');
    }

    public function edit(Newsletter $newsletter)
    {
        if ($newsletter->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have permission to edit this newsletter.');
        }
        
        return view('newsletters.edit', compact('newsletter'));
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        if ($newsletter->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have permission to edit this newsletter.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        $newsletter->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        
        return redirect()->route('dashboard')->with('success', 'Newsletter updated successfully!');
    }

    public function destroy(Newsletter $newsletter)
    {
        if ($newsletter->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have permission to delete this newsletter.');
        }
        
        $newsletter->delete();
        
        return redirect()->route('dashboard')->with('success', 'Newsletter deleted successfully!');
    }

    public function show(Newsletter $newsletter)
    {
        $isSubscribed = false;
        
        if (auth()->check()) {
            $isSubscribed = auth()->user()->subscriptions->contains($newsletter->id);
        }
        
        return view('newsletters.show', compact('newsletter', 'isSubscribed'));
    }

    public function subscribe(Newsletter $newsletter)
    {
        $user = auth()->user();
        
        if (!$user->subscriptions->contains($newsletter->id)) {
            $user->subscriptions()->attach($newsletter->id);
            return redirect()->back()->with('success', 'Successfully subscribed to the newsletter!');
        }
        
        return redirect()->back()->with('info', 'You are already subscribed to this newsletter.');
    }

    public function unsubscribe(Newsletter $newsletter)
    {
        $user = auth()->user();
        
        if ($user->subscriptions->contains($newsletter->id)) {
            $user->subscriptions()->detach($newsletter->id);
            return redirect()->back()->with('success', 'Successfully unsubscribed from the newsletter.');
        }
        
        return redirect()->back()->with('info', 'You are not subscribed to this newsletter.');
    }
}
