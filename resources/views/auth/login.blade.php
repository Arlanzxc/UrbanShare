<x-guest-layout>
    <div class="min-h-screen bg-slate-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex flex-col items-center justify-center mb-6">
                <div class="w-12 h-12 rounded-xl bg-violet-600 flex items-center justify-center shadow-lg shadow-violet-500/20 mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Welcome back</h2>
                <p class="mt-2 text-sm text-slate-500 font-medium">
                    Or 
                    <a href="{{ route('register') }}" class="font-bold text-violet-600 hover:text-violet-500 transition-colors">
                        create your free account
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
            <div class="bg-white py-10 px-6 sm:px-10 rounded-[24px] border border-slate-200/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com" 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400">
                        @error('email') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-violet-600 hover:text-violet-500 transition-colors">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400">
                        @error('password') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="relative flex items-center cursor-pointer select-none">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-violet-600 border-slate-300 rounded focus:ring-violet-500/20 transition-all cursor-pointer">
                            <span class="ms-2 text-sm font-medium text-slate-500">Remember this device</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-violet-600/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0 focus:outline-none">
                            Sign In
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>