<nav
    x-data="{
        mobileOpen: false,
        notifOpen: false,
        profileOpen: false,
        closeAll() { this.notifOpen = false; this.profileOpen = false; }
    }"
    @keydown.escape.window="closeAll()"
    @click.outside="closeAll()"
    class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-slate-200 shadow-sm"
>
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24">

            <div class="flex items-center gap-10 lg:gap-14">
                
                <a href="{{ route('items.index') }}" class="flex items-center gap-3 shrink-0 group">
                    <div class="w-12 h-12 rounded-[16px] bg-violet-600 flex items-center justify-center shadow-lg shadow-violet-500/20 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-black text-violet-700 tracking-tight">
                        UrbanShare
                    </span>
                </a>

                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="relative px-6 py-3 rounded-2xl text-base font-bold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-50/80 text-indigo-600' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
                            {{ __('Dashboard') }}
                            @if(request()->routeIs('dashboard'))
                                <span class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full bg-indigo-500"></span>
                            @endif
                        </a>
                    @endauth

                    <a href="{{ route('items.index') }}" class="relative px-6 py-3 rounded-2xl text-base font-bold transition-all duration-200 {{ request()->routeIs('items.index') ? 'bg-indigo-50/80 text-indigo-600' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
                        {{ __('Catalog') }}
                        @if(request()->routeIs('items.index'))
                            <span class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full bg-indigo-500"></span>
                        @endif
                    </a>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('items.create') }}" class="flex items-center gap-3 px-6 py-3 bg-[#252525] hover:bg-black text-white rounded-[16px] shadow-lg shadow-black/10 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        <div class="flex flex-col text-left font-bold text-[14px] leading-[16px]">
                            <span>List a</span>
                            <span>Tool</span>
                        </div>
                    </a>

                    <div class="relative" x-data>
                        <button @click.stop="notifOpen = !notifOpen; profileOpen = false" 
                                class="relative w-14 h-14 border rounded-[16px] flex items-center justify-center transition-all shadow-sm
                                {{ auth()->user()->unreadNotifications->count() > 0 
                                    ? 'bg-violet-50 border-violet-200 text-violet-600 hover:bg-violet-100 shadow-violet-500/10' 
                                    : 'bg-white border-slate-200 text-slate-400 hover:text-slate-600 hover:bg-slate-50' }}">
                            
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-3 right-3 flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500 ring-2 ring-white"></span>
                                </span>
                            @endif
                        </button>

                        <div x-show="notifOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-2" @click.outside="notifOpen = false" class="absolute right-0 mt-3 w-[400px] rounded-[24px] bg-white shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-slate-100 overflow-hidden" style="display:none;">
                            
                            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-50">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-bold text-slate-900">Notifications</h3>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 border border-slate-100 rounded-xl text-xs font-bold text-slate-400 hover:text-slate-600 hover:border-slate-300 transition-colors">
                                                Mark all read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                
                            </div>

                            <div class="max-h-[400px] overflow-y-auto p-2 space-y-1">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-slate-50 cursor-pointer transition-colors">
                                        <div class="mt-1.5 w-2.5 h-2.5 shrink-0 rounded-full bg-violet-500 shadow-sm shadow-violet-500/50"></div>
                                        <div>
                                            <p class="text-[15px] font-bold text-slate-800 leading-snug">
                                                {{ $notification->data['message'] ?? 'You have a new notification!' }}
                                            </p>
                                            <p class="text-[14px] text-violet-500 mt-1 font-medium">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-12 text-center">
                                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                        </div>
                                        <p class="text-base font-bold text-slate-500">All caught up!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <button @click.stop="profileOpen = !profileOpen; notifOpen = false" class="flex items-center gap-3 pl-2.5 pr-5 py-2.5 bg-white border border-slate-200 rounded-[18px] hover:bg-slate-50 transition-colors shadow-sm">
                            @if(Auth::user()->avatar)
                                <div class="w-10 h-10 rounded-[14px] overflow-hidden shadow-sm border border-slate-200 shrink-0">
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-[14px] bg-violet-500 flex items-center justify-center text-white font-black text-base shadow-inner shrink-0">
                                    {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex flex-col text-left font-bold text-[14px] leading-[16px] text-slate-700">
                                @php
                                    $names = explode(' ', Auth::user()->name);
                                    $firstName = $names[0] ?? '';
                                    $lastName = $names[1] ?? '';
                                @endphp
                                <span>{{ $firstName }}</span>
                                @if($lastName)
                                    <span>{{ $lastName }}</span>
                                @endif
                            </div>
                            <svg class="w-4 h-4 text-slate-400 ml-2 transition-transform" :class="{'rotate-180': profileOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="profileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-2" @click.outside="profileOpen = false" class="absolute right-0 mt-3 w-56 rounded-[24px] bg-white shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-slate-100 p-2" style="display:none;">
                            <a href="{{ route('profile.edit') }}" class="block px-5 py-3 text-base text-slate-600 font-bold hover:bg-slate-50 hover:text-slate-900 rounded-2xl transition-colors">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-5 py-3 text-base font-bold text-rose-500 hover:bg-rose-50 rounded-2xl transition-colors mt-1">Log out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-base font-bold text-slate-500 hover:text-slate-900 px-5 py-3 transition-colors">Log in</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white text-base font-bold rounded-2xl shadow-lg shadow-violet-500/30 transition-all">Sign up</a>
                @endauth
            </div>

            <div class="flex md:hidden items-center gap-2">
                @auth
                    <button class="relative w-12 h-12 bg-white border border-slate-200 rounded-[14px] flex items-center justify-center text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-2.5 right-2.5 w-3 h-3 rounded-full bg-rose-500 ring-2 ring-white"></span>
                        @endif
                    </button>
                @endauth
                <button @click="mobileOpen = !mobileOpen" class="w-12 h-12 flex items-center justify-center text-slate-500 hover:text-slate-900 bg-slate-50 rounded-[14px]">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileOpen" x-transition class="md:hidden border-t border-slate-100 bg-white" style="display:none;">
        <div class="px-4 py-4 space-y-2">
            <a href="{{ route('items.index') }}" class="block px-5 py-4 rounded-2xl text-lg font-bold {{ request()->routeIs('items.index') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600' }}">Catalog</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-5 py-4 rounded-2xl text-lg font-bold {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600' }}">Dashboard</a>
                <a href="{{ route('items.create') }}" class="block px-5 py-4 rounded-2xl text-lg font-bold text-white bg-[#252525]">List a Tool</a>
                <div class="border-t border-slate-100 mt-6 pt-6">
                    <a href="{{ route('profile.edit') }}" class="block px-5 py-4 text-slate-600 font-bold text-lg">Profile Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-5 py-4 text-rose-500 font-bold text-lg">Log out</button>
                    </form>
                </div>
            @else
                <div class="pt-6 border-t border-slate-100 flex flex-col gap-4">
                    <a href="{{ route('login') }}" class="w-full text-center py-4 bg-slate-100 rounded-2xl font-bold text-lg text-slate-700">Log in</a>
                    <a href="{{ route('register') }}" class="w-full text-center py-4 bg-violet-600 rounded-2xl font-bold text-lg text-white">Sign up</a>
                </div>
            @endauth
        </div>
    </div>
</nav>