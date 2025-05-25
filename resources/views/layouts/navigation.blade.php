<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center w-full">

      <!-- Left side: Logo + All Newsletters -->
      <div class="flex items-center space-x-6">
        <a href="{{ route('dashboard') }}">
          <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>

        <x-nav-link :href="route('newsletters.index')" :active="request()->routeIs('newsletters.index')">
          {{ __('All Newsletters') }}
        </x-nav-link>
      </div>

      <!-- Right side: Auth links -->
      <div class="hidden sm:flex items-center space-x-4">
        @guest
          <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Log in') }}
          </x-nav-link>
          <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
            {{ __('Register') }}
          </x-nav-link>
        @endguest

        @auth
          @if (auth()->user()->role === 'subscriber')
            <x-nav-link :href="route('subscriptions.my')" :active="request()->routeIs('subscriptions.my')">
              {{ __('My Subscriptions') }}
            </x-nav-link>
          @elseif (auth()->user()->role === 'customer')
            <x-nav-link :href="route('subscribers.my')" :active="request()->routeIs('subscribers.my')">
              {{ __('My Subscribers') }}
            </x-nav-link>
            <x-nav-link :href="route('newsletter.my.edit')" :active="request()->routeIs('newsletter.my.edit')">
              {{ __('My Newsletter') }}
            </x-nav-link>
          @endif

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-700 dark:text-gray-300 underline">
              {{ __('Log Out') }}
            </button>
          </form>
        @endauth
      </div>

      <!-- Mobile toggle -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('newsletters.index')" :active="request()->routeIs('newsletters.index')">
        {{ __('All Newsletters') }}
      </x-responsive-nav-link>

      @guest
        <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
          {{ __('Log in') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
          {{ __('Register') }}
        </x-responsive-nav-link>
      @endguest

      @auth
        @if (auth()->user()->role === 'subscriber')
          <x-responsive-nav-link :href="route('subscriptions.my')" :active="request()->routeIs('subscriptions.my')">
            {{ __('My Subscriptions') }}
          </x-responsive-nav-link>
        @elseif (auth()->user()->role === 'customer')
          <x-responsive-nav-link :href="route('subscribers.my')" :active="request()->routeIs('subscribers.my')">
            {{ __('My Subscribers') }}
          </x-responsive-nav-link>
          <x-responsive-nav-link :href="route('newsletter.my.edit')" :active="request()->routeIs('newsletter.my.edit')">
            {{ __('My Newsletter') }}
          </x-responsive-nav-link>
        @endif

        <form method="POST" action="{{ route('logout') }}" class="mt-1">
          @csrf
          <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>
      @endauth
    </div>
  </div>
</nav>
