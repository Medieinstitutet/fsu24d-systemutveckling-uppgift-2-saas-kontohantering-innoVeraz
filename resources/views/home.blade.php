@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('status') }}
        </div>
    @endif

    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Newsletter Service</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Create and manage newsletters or subscribe to content that interests you</p>
    </div>
    
    @guest
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 text-center">
            <h2 class="text-2xl font-semibold mb-4">Welcome</h2>
            <p class="mb-8 mx-auto max-w-sm">Log in to manage your newsletters or subscriptions, or create an account if you're new here.</p>
            
            <div class="flex flex-col justify-center gap-4 max-w-xs  mx-auto">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg text-center hover:bg-blue-700 flex-grow">
                    Login to your account
                </a>
                <a href="{{ route('register') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg text-center hover:bg-gray-300 flex-grow">
                    Create new account
                </a>
            </div>
        </div>
    @endguest
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">For Subscribers</h3>
            <p class="text-gray-600 mb-4">Discover and subscribe to newsletters that interest you. Stay updated with the latest content from your favorite publishers.</p>
            <a href="{{ route('newsletters.index') }}" class="text-blue-600 hover:text-blue-800">Browse newsletters</a>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">For Content Creators</h3>
            <p class="text-gray-600 mb-4">Create your own newsletter, grow your audience, and connect with subscribers interested in your content.</p>
            @guest
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">Get started</a>
            @else
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">Go to dashboard</a>
            @endguest
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">How It Works</h3>
            <ul class="space-y-2 text-gray-600">
                <li>✓ Create an account as a subscriber or content creator</li>
                <li>✓ Find newsletters that interest you</li>
                <li>✓ Manage your subscriptions easily</li>
                <li>✓ Creators can track their subscriber base</li>
            </ul>
        </div>
    </div>
</div>
@endsection
