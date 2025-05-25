@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
  <div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="bg-blue-600 text-white px-6 py-4">
      <h1 class="text-2xl font-bold">My Subscribers</h1>
      <p class="text-blue-100 text-sm mt-1">People who have subscribed to your newsletter</p>
    </div>

    <div class="p-6">
      @if(count($subscribers) > 0)
        <p class="text-gray-600 mb-4">You have {{ count($subscribers) }} subscriber(s) to your newsletter.</p>
        
        <ul class="space-y-3 mt-4">
          @foreach($subscribers as $user)
            <li class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
              <div class="flex-shrink-0 bg-blue-100 rounded-full p-2 mr-3">
                <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <div>
                <span class="font-medium">{{ $user->name }}</span>
                <span class="text-gray-500 text-sm ml-2">({{ $user->email }})</span>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <div class="text-center py-8">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          <h3 class="mt-2 text-sm font-medium text-gray-900">No subscribers yet</h3>
          <p class="mt-1 text-sm text-gray-500">
            Your newsletter doesn't have any subscribers yet.
          </p>
        </div>
      @endif
    </div>
  </div>
  
  <div class="mt-8 text-center">
    <a href="{{ route('newsletter.my.edit') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
      </svg>
      Edit My Newsletter
    </a>
  </div>
</div>
@endsection