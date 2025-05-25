<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h2>
                    <p class="mb-4">You are logged in as a <strong>{{ ucfirst(auth()->user()->role) }}</strong>.</p>
                    
                    @if(auth()->user()->role === 'subscriber')
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold mb-3">Subscriber Options:</h3>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('newsletters.index') }}" class="text-blue-600 hover:text-blue-800">
                                        Browse available newsletters
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscriptions.my') }}" class="text-blue-600 hover:text-blue-800">
                                        Manage your subscriptions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @elseif(auth()->user()->role === 'customer')
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold mb-3">Customer Options:</h3>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('newsletter.my.edit') }}" class="text-blue-600 hover:text-blue-800">
                                        Manage your newsletter
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscribers.my') }}" class="text-blue-600 hover:text-blue-800">
                                        View your subscribers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
