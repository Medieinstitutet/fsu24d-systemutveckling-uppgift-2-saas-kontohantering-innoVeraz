@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
  <div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="bg-blue-600 text-white px-6 py-4">
      <h1 class="text-2xl font-bold">Edit Newsletter</h1>
      <p class="text-blue-100 text-sm mt-1">Update your newsletter information</p>
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

      <form method="POST" action="{{ route('newsletters.update', $newsletter) }}" class="space-y-6">
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
        
        <div class="pt-4 border-t border-gray-200 flex items-center justify-between">
          <div class="text-sm text-gray-500">
            Created on {{ $newsletter->created_at->format('F j, Y') }}<br>
            Last updated {{ $newsletter->updated_at->diffForHumans() }}
          </div>
          <div class="flex">
            <a href="{{ route('dashboard') }}" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-2">
              Cancel
            </a>
            <button type="submit" class="py-2 px-6 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors">
              Save Changes
            </button>
          </div>
        </div>
      </form>

      <div class="mt-8 pt-6 border-t border-gray-200">
        <form method="POST" action="{{ route('newsletters.destroy', $newsletter) }}" onsubmit="return confirm('Are you sure you want to delete this newsletter? This action cannot be undone.');">
          @csrf
          @method('DELETE')
          <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition-colors text-sm">
            Delete This Newsletter
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="mt-8 text-center">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      Back to Dashboard
    </a>
  </div>
</div>
@endsection