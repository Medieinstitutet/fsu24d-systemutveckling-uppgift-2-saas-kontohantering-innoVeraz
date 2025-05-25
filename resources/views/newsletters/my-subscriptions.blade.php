@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">My Subscriptions</h1>
    
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <ul class="space-y-4">
      @forelse($subscriptions as $newsletter)
        <li class="p-4 border rounded bg-white shadow-md">
          <div class="flex justify-between items-start">
            <div>
              <h2 class="text-xl font-semibold">{{ $newsletter->name }}</h2>
              <p class="text-gray-600 mt-2">{{ $newsletter->description }}</p>
              <p class="text-sm text-gray-500 mt-2">By {{ $newsletter->user->name ?? 'Unknown' }}</p>
            </div>
            <form action="{{ route('newsletters.unsubscribe', $newsletter) }}" method="POST">
              @csrf
              <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Unsubscribe
              </button>
            </form>
          </div>
        </li>
      @empty
        <li class="p-8 border rounded bg-white shadow-md text-center">
          <p class="text-gray-600 mb-4">You have no subscriptions yet.</p>
          <a href="{{ route('newsletters.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Browse available newsletters
          </a>
        </li>
      @endforelse
    </ul>

    @if(count($subscriptions) > 0)
      <div class="mt-6">
        <h2 class="text-lg font-semibold mb-3">Looking for more newsletters?</h2>
        <a href="{{ route('newsletters.index') }}" class="text-blue-600 hover:text-blue-800">
          Browse all available newsletters
        </a>
      </div>
    @endif
  </div>
@endsection