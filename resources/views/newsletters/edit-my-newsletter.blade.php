@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
  <div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="bg-blue-600 text-white px-6 py-4">
      <h1 class="text-2xl font-bold">Manage Your Newsletter</h1>
      <p class="text-blue-100 text-sm mt-1">Update the details of your publication</p>
    </div>

    <div class="p-6">
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center">
          <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          {{ session('success') }}
        </div>
      @endif

      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
          {{ session('error') }}
        </div>
      @endif

      <form method="POST" action="{{ route('newsletter.my.update') }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Newsletter Title</label>
          <input type="text" id="name" name="name" value="{{ old('name', $newsletter->name) }}" 
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-lg"
            placeholder="Enter a compelling title for your newsletter">
          @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
          <textarea id="description" name="description" rows="6"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            placeholder="Describe what your newsletter is about and why people should subscribe">{{ old('description', $newsletter->description) }}</textarea>
          @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        
        <div class="pt-4 border-t border-gray-200">
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Last updated: {{ $newsletter->updated_at->format('F j, Y') }}</span>
            <button type="submit" class="py-2 px-6 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors">
              Save Changes
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <div class="mt-8 text-center">
    <a href="{{ route('subscribers.my') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
      </svg>
      View My Subscribers
    </a>
  </div>
</div>
@endsection