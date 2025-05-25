@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">All Newsletters</h1>
    
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse ($newsletters as $newsletter)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
          <div class="p-6">
            <h2 class="text-xl font-semibold mb-2">{{ $newsletter->name }}</h2>
            <p class="text-gray-600 mb-4">{{ Str::limit($newsletter->description, 100) }}</p>
            
            <div class="mt-4 flex justify-between items-center">
              <span class="text-sm text-gray-500">
                By {{ $newsletter->user->name ?? 'Unknown' }}
              </span>
              <a href="{{ route('newsletters.show', $newsletter) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                View Details
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-8">
          <p class="text-gray-600">No newsletters available yet.</p>
        </div>
      @endforelse
    </div>
  </div>
@endsection
