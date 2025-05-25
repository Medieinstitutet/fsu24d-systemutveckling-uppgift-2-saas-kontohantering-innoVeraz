@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-xl overflow-hidden mb-6">
                <div class="px-6 py-8 md:flex items-center justify-between">
                    <div class="text-white mb-4 md:mb-0">
                        <h2 class="text-3xl font-bold mb-2">Welcome {{ auth()->user()->name }}!</h2>
                    </div>
                    
                    @if(auth()->user()->role === 'customer')
                        <div class="flex flex-wrap gap-3">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-4 py-2 text-white text-center">
                                <div class="text-2xl font-bold">{{ auth()->user()->newsletters->count() }}</div>
                                <div class="text-xs">Newsletters</div>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-4 py-2 text-white text-center">
                                <div class="text-2xl font-bold">
                                    {{ auth()->user()->newsletters->sum(function($newsletter) { 
                                        return $newsletter->subscribers->count(); 
                                    }) }}
                                </div>
                                <div class="text-xs">Subscribers</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            @if(auth()->user()->role === 'subscriber')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-semibold mb-3">Your Subscriber Options:</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <h3 class="text-blue-800 font-medium mb-2">My Subscriptions</h3>
                                <p class="text-sm text-gray-600 mb-3">View and manage your newsletter subscriptions</p>
                                <a href="{{ route('subscriptions.my') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                    Manage subscriptions →
                                </a>
                            </div>
                            
                            <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                                <h3 class="text-green-800 font-medium mb-2">Explore Newsletters</h3>
                                <p class="text-sm text-gray-600 mb-3">Browse available newsletters to subscribe to</p>
                                <a href="{{ route('newsletters.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800">
                                    Discover newsletters →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->role === 'customer')
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold">Newsletters</h2>
                   
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="divide-y">
                            @forelse(auth()->user()->newsletters as $index => $newsletter)
                                <div class="p-6 flex flex-wrap md:flex-nowrap items-center gap-4">
                                    <div class="newsletter-icon flex-shrink-0 w-16 h-16 rounded-lg flex items-center justify-center text-2xl font-bold 
                                        {{ ['bg-pink-100 text-pink-800', 'bg-purple-100 text-purple-800', 'bg-indigo-100 text-indigo-800', 'bg-blue-100 text-blue-800', 'bg-green-100 text-green-800'][$index % 5] }}">
                                        {{ substr($newsletter->name, 0, 2) }}
                                    </div>
                                    
                                    <div class="flex-grow min-w-0">
                                        <h3 class="text-lg font-semibold truncate">{{ $newsletter->name }}</h3>
                                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-600">
                                            <span class="flex items-center">
                                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $newsletter->subscribers->count() }} subscribers
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $newsletter->created_at->format('M d, Y') }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Last updated {{ $newsletter->updated_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 ml-auto">
                                        <a href="{{ route('newsletters.edit', $newsletter) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">
                                            Edit
                                        </a>
                                        <form action="{{ route('newsletters.destroy', $newsletter) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this newsletter?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="p-10 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No newsletters</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by creating a newsletter.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('newsletters.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Create Newsletter
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <h3 class="font-semibold text-lg mb-4 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                Subscriber Growth
                            </h3>
                            <div class="h-28 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-gray-800">
                                        {{ auth()->user()->newsletters->sum(function($newsletter) { 
                                            return $newsletter->subscribers->count(); 
                                        }) }}
                                    </div>
                                    <div class="text-sm text-gray-500">Total Subscribers</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <h3 class="font-semibold text-lg mb-4 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Quick Actions
                            </h3>
                            <div class="space-y-2">
                                <a href="{{ route('newsletter.my.edit') }}" class="block p-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                                    <div class="font-medium">Edit Newsletter</div>
                                    <div class="text-xs text-purple-600">Update your newsletter content</div>
                                </a>
                                <a href="{{ route('subscribers.my') }}" class="block p-3 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors">
                                    <div class="font-medium">View Subscribers</div>
                                    <div class="text-xs text-green-600">See who's subscribed to your newsletter</div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-lg shadow-sm p-6 border border-amber-100">
                            <h3 class="font-semibold text-lg mb-4 flex items-center text-amber-800">
                                <svg class="h-5 w-5 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                Tips For Success
                            </h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 mr-1 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-amber-800">Keep your newsletter description engaging to attract more subscribers.</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 mr-1 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-amber-800">Regular updates keep subscribers engaged.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
