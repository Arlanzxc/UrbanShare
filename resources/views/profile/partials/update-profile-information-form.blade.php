<section>
    <header>
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
            Profile Information
        </h2>
        <p class="mt-1 text-sm text-slate-500 font-medium">
            Update your account's profile information, email address, and photo.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div x-data="{ imagePreview: '{{ $user->avatar ? Storage::url($user->avatar) : '' }}' }">
            <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-3">Profile Photo</label>
            
            <div class="flex items-center gap-6">
                <div class="relative w-24 h-24 rounded-full overflow-hidden bg-slate-100 border-2 border-slate-200 shrink-0 shadow-inner">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" class="w-full h-full object-cover">
                    </template>
                    
                    <template x-if="!imagePreview">
                        <div class="w-full h-full flex items-center justify-center bg-violet-100 text-violet-500 font-black text-3xl">
                            {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                        </div>
                    </template>
                </div>
                
                <div>
                    <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden" x-ref="avatarInput" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                    
                    <button type="button" @click="$refs.avatarInput.click()" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold text-sm rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                        Upload new photo
                    </button>
                    <p class="mt-2 text-[11px] text-slate-400 font-medium uppercase tracking-wider">JPG, PNG or WEBP · Max 5MB</p>
                </div>
            </div>
            @error('avatar') <p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="name" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all">
            @error('name') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all">
            @error('email') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-violet-600/30 transition-all transform hover:-translate-y-0.5">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-emerald-600 font-bold flex items-center gap-1.5">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>