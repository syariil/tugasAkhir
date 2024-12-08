<nav class="fixed top-0 z-50 w-full  bg-gray-800 border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm  rounded-lg sm:hidden  focus:outline-none focus:ring-2  text-gray-400 hover:bg-red-600 focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
                    <img src="{{ asset('storage/image/logo.png') }}" class="md:h-8 h-6 rounded-full"
                        alt="Kabaena Logo" />
                    <span
                        class="self-center text-xl font-kodeMono font-semibold sm:text-2xl whitespace-nowrap text-white">Kabaena<span
                            class="text-red-600">Cup</span></span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-900  text-white font-poppins focus:ring-4  focus:ring-gray-600 py-3 px-4 rounded-lg"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            {{ Auth::user()->nama }}
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none  divide-y  rounded shadow bg-gray-700 divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm  text-white" role="none">
                                {{ Auth::user()->username }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('profile.index') }}"
                                    class="block px-4 py-2 text-sm  text-gray-300 hover:bg-gray-600 hover:text-white"
                                    role="menuitem">Settings</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm  text-gray-300 hover:bg-gray-600 hover:text-white"
                                    role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full  border-r  sm:translate-x-0 bg-gray-800 border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto  bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ url('/admin') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 {{ Request::routeIs('dashboard') ? 'bg-red-600' : '' }}">
                    <x-uiw-dashboard class="w-[20px]" />
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/tim') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 {{ Request::routeIs('tim') ? 'bg-red-600' : '' }}">
                    <x-uiw-user class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Tim</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/schedule') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 {{ Request::routeIs('schedule.admin') ? 'bg-red-600' : '' }}">
                    <x-uiw-date class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Schedule</span>

                </a>
            </li>
            <li>
                <a href="{{ route('standing.index') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 {{ Request::routeIs('standing.index') ? 'bg-red-600' : '' }}">
                    <x-uiw-dot-chart class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Standing</span>

                </a>
            </li>
            <li>
                <a href="{{ route('grup.index') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 {{ Request::routeIs('grup.index') ? 'bg-red-600' : '' }}">
                    <x-uni-users-alt-o class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Grup</span>

                </a>
            </li>
            <li>
                <a href="{{ route('konf_register') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 {{ Request::routeIs('konf_register') ? 'bg-red-600' : '' }}">
                    <x-uiw-user-add class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Registration</span>
                </a>
            </li>
            <li>
                <a href="{{ route('highlight.index') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 {{ Request::routeIs('highlight.index') ? 'bg-red-600' : '' }}">
                    <x-uiw-video-camera class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Highlight</span>
                </a>
            </li>
            <li>
                <a href="{{ route('system.index') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 group {{ Request::routeIs('system.index') ? 'bg-red-600' : '' }}">
                    <x-uiw-setting-o class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">System</span>

                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    class="flex items-center p-2  rounded-lg text-white  hover:bg-red-600 group">
                    <x-uiw-logout class="w-[20px]" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
                </a>
            </li>

        </ul>
        <footer class=" rounded-lg shadow mt-4 bg-gray-800 bottom-0">
            <div class="w-full mx-auto max-w-screen-xl p-4 flex items-center justify-center ">
                <span class="text-sm  sm:text-center text-gray-400">© 2023 Kabaena Cup™. All Rights Reserved.
                </span>
            </div>
        </footer>
    </div>
</aside>
