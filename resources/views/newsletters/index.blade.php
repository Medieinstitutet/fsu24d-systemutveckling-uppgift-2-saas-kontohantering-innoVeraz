@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-8 border-b pb-4">
      <h1 class="text-3xl font-serif font-bold">Available Publications</h1>
      
      <form method="GET" action="{{ route('newsletters.index') }}" class="flex">
        <input type="text" name="search" placeholder="Search by title or topic..." 
               value="{{ request('search') }}"
               class="px-4 py-2 border rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700">
          Search
        </button>
      </form>
    </div>
    
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
      </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse ($newsletters as $newsletter)
        <div class="bg-white shadow-md rounded-lg overflow-hidden h-full flex flex-col transition-transform hover:scale-105 hover:shadow-lg">
          <div class="p-6 flex-grow">
            <div class="text-sm text-gray-500 mb-2 font-serif">
              {{ $newsletter->created_at->format('F j, Y') }}
            </div>
            <h2 class="text-xl font-bold font-serif mb-3 border-b pb-2">{{ $newsletter->name }}</h2>
            <p class="text-gray-600 mb-4">{{ Str::limit($newsletter->description, 120) }}</p>
          </div>

          <div class="border-t bg-gray-50 p-4 flex justify-between items-center">
            <span class="text-sm text-gray-600 italic">
              By {{ str_replace(['Test Customer 1', 'Test Customer 2'], 'Editor', $newsletter->user->name ?? 'Anonymous') }}
            </span>
            <a href="{{ route('newsletters.show', $newsletter) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
              Read More
            </a>
          </div>
            
          @auth
            @if(auth()->user()->subscriptions->contains($newsletter->id))
              <div class="bg-green-50 text-sm text-green-700 py-2 px-4 flex items-center justify-center border-t">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Subscribed
              </div>
            @endif
          @endauth
        </div>
      @empty
        <div class="col-span-full text-center py-16">
          <p class="text-gray-600 text-lg">No publications found{{ request('search') ? ' matching "'.request('search').'"' : '' }}.</p>
          <p class="mt-2 text-gray-500">Try adjusting your search or check back later for new content.</p>
        </div>
      @endforelse
    </div>
    
    @if(count($newsletters) > 0)
      <div class="mt-8 flex justify-center">
        <!-- Pagination could go here in the future -->
      </div>
    @endif
  </div>
@endsection
