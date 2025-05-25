@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">My Subscribers</h1>

  <ul class="space-y-2">
    @forelse($subscribers as $user)
      <li class="border-b py-2">{{ $user->name }} ({{ $user->email }})</li>
    @empty
      <li>No subscribers yet.</li>
    @endforelse
  </ul>
@endsection