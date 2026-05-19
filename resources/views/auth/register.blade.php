<x-guest-layout>
    <div class="flex min-h-screen bg-white">
        
        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-28">
            <div class="w-full max-w-sm mx-auto lg:w-96">
                
                <div>
                    <a href="{{ route('items.index') }}" class="flex items-center gap-3 group">
                        <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-violet-600 shadow-lg shadow-violet-500/30 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-slate-900">UrbanShare</span>
                    </a>
                    <h2 class="mt-8 text-3xl font-black tracking-tight text-slate-900">Create account</h2>
                    <p class="mt-2 text-sm font-medium text-slate-500">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-bold text-violet-600 transition-colors hover:text-violet-700">
                            Sign in instead
                        </a>
                    </p>
                </div>

                <div class="mt-10">
                    <form action="{{ route('register') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Full Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Alex Chen" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400">
                            @error('name') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400">
                            @error('email') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400">
                            @error('password') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400">
                            @error('password_confirmation') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="flex items-center justify-center w-full gap-2 px-4 py-3.5 text-sm font-bold text-white transition-all transform shadow-lg bg-violet-600 hover:bg-violet-700 rounded-xl shadow-violet-600/30 hover:-translate-y-0.5 active:translate-y-0">
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="relative hidden w-full lg:block lg:flex-1">
            <div class="absolute inset-0 w-full h-full bg-slate-900 overflow-hidden">
                <img class="absolute inset-0 object-cover w-full h-full opacity-40 mix-blend-overlay scale-105" 
                     src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" 
                     alt="Tools background">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40"></div>
                
                <div class="absolute inset-0 flex flex-col justify-end px-16 pb-24">
                    <div class="w-16 h-2 bg-violet-500 mb-6 rounded-full"></div>
                    <blockquote class="text-3xl font-black text-white max-w-xl leading-tight">
                        "UrbanShare helped me find the exact tools I needed for my weekend project without spending a fortune."
                    </blockquote>
                    <div class="mt-8 flex items-center gap-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <span class="text-slate-300 font-medium">Join thousands of users in Almaty</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</x-guest-layout>