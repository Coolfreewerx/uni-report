
<nav class="bg-green-400 px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
  <div class="container flex flex-wrap justify-between items-center mx-auto">
    <a a href="{{ url('/') }}" class="flex items-center text-white">
        <img src="/public/images/soccaass_logo_black.png" class="mr-3 h-6 sm:h-9" alt="logo">
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Report System</span>
    </a>
  
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-white-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 " aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
  
  <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 mt-4 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white ">
                @auth
                    <li>
                        {{ Auth::user()->email }}
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'posts.index') current-page @endif" >
                            รายการร้องเรียน
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.create') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'posts.create') current-page @endif">
                            แจ้งปัญหา
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tags.index') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'tags.index') current-page @endif" >
                            Tags
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sectors.index') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'sectors.index') current-page @endif" >
                            ระบบหน่วยงาน
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'login') current-page @endif" >
                            Login
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('register') }}"
                           class="block py-2 pr-4 pl-3 rounded md:p-0 hover:underline @if(Route::currentRouteName() === 'register') current-page @endif" >
                            Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
