<x-guest-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex flex-col items-center justify-center mb-6">
                <a href="{{ route('items.index') }}" class="w-12 h-12 rounded-xl bg-violet-600 flex items-center justify-center shadow-lg shadow-violet-500/20 mb-4 hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2v4a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2h8z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v2m0 0h.01M12 17h.01M8 12h.01M16 12h.01"/>
                    </svg>
                </a>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Forgot password?</h2>
                <p class="mt-2 text-sm text-slate-500 font-medium max-w-sm text-center px-4 leading-relaxed">
                    No problem. Just let us know your email address and we will email you a password reset link.
                </p>
            </div>
        </div>

        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
            <div class="bg-white py-8 px-6 sm:px-10 rounded-[24px] border border-slate-200/60 shadow-[0_8px_30px_rgb(0,0,0,0.03)]">
                
                @if (session('status'))
                    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-semibold rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400">
                        @error('email') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-violet-600/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0 focus:outline-none">
                            Email Password Reset Link
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center border-t border-slate-100 pt-5">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to sign in
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>