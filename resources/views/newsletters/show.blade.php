@extends('layouts.app')

@section('content')
  <div class="max-w-2xl mx-auto py-6">
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if (session('info'))
      <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
        {{ session('info') }}
      </div>
    @endif

    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    <h1 class="text-2xl font-bold mb-4">{{ $newsletter->name }}</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <p class="text-gray-700 mb-4">{{ $newsletter->description }}</p>
      
      <div class="flex items-center justify-between mt-4">
        <div class="text-sm text-gray-500">
          Created by {{ $newsletter->user->name ?? 'Unknown' }}
        </div>
        
        @auth
          @if ($isSubscribed)
            <form action="{{ route('newsletters.unsubscribe', $newsletter) }}" method="POST">
              @csrf
              <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Unsubscribe
              </button>
            </form>
          @else
            <form action="{{ route('newsletters.subscribe', $newsletter) }}" method="POST">
              @csrf
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Subscribe
              </button>
            </form>
          @endif
        @else
          <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Login to Subscribe
          </a>
        @endauth
      </div>
    </div>
    
    <a href="{{ route('newsletters.index') }}" class="text-blue-600 hover:text-blue-800">
      &larr; Back to All Newsletters
    </a>
  </div>
@endsection