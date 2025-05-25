@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">My Subscriptions</h1>

  <ul class="space-y-4">
    @forelse($subscriptions as $newsletter)
      <li class="p-4 border rounded">
        <h2 class="text-xl font-semibold">{{ $newsletter->name }}</h2>
        <p class="text-gray-600">{{ $newsletter->description }}</p>
      </li>
    @empty
      <li>You have no subscriptions yet.</li>
    @endforelse
  </ul>
@endsection