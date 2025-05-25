@extends('layouts.app')

@section('content')
  <div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">All Newsletters</h1>

    <ul class="space-y-4">
      @forelse($newsletters as $newsletter)
        <li class="p-4 border rounded flex justify-between items-center">
          <div>
            <h2 class="text-xl font-semibold">{{ $newsletter->name }}</h2>
            <p class="text-gray-600">{{ $newsletter->description }}</p>
            <small class="text-sm text-gray-500">{{ $newsletter->subscribers->count() }} subscribers</small>
          </div>
          <div>
            @auth
              @if(auth()->user()->subscriptions->contains($newsletter->id))
                <form action="{{ route('newsletters.unsubscribe', $newsletter) }}" method="POST">
                  @csrf
                  <button class="px-4 py-2 bg-red-500 text-white rounded">Unsubscribe</button>
                </form>
              @else
                <form action="{{ route('newsletters.subscribe', $newsletter) }}" method="POST">
                  @csrf
                  <button class="px-4 py-2 bg-blue-500 text-white rounded">Subscribe</button>
                </form>
              @endif
            @else
              <span class="text-sm text-gray-400">Log in to subscribe</span>
            @endauth
          </div>
        </li>
      @empty
        <li>No newsletters available.</li>
      @endforelse
    </ul>
  </div>
@endsection
