<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <p class="text-center text-base font-bold text-slate-400 uppercase tracking-widest mb-10">
                Fill in the details below · Your tool will be listed after review
            </p>

            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" x-data="{ imagePreview: null }">
                @csrf

                <div class="bg-white rounded-[32px] border border-slate-200/60 overflow-hidden mb-8 shadow-sm">
                    <div class="flex items-center gap-5 p-8 sm:px-12 sm:py-8 border-b border-slate-100">
                        <div class="w-16 h-16 rounded-2xl bg-violet-50 flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Basic Information</h3>
                            <p class="text-base text-slate-500 mt-1">What tool are you listing?</p>
                        </div>
                        <span class="ml-auto text-base font-bold text-violet-600 bg-violet-50 px-5 py-2 rounded-full">Step 1 of 3</span>
                    </div>
                    
                    <div class="p-8 sm:p-12 flex flex-col gap-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-600 uppercase tracking-widest mb-3">Tool Name <span class="text-violet-600">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Bosch Power Drill Pro 18V" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-lg text-slate-900 font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all placeholder-slate-400" required>
                            @error('title') <p class="text-base text-red-500 mt-2 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-bold text-slate-600 uppercase tracking-widest mb-3">Category <span class="text-violet-600">*</span></label>
                                <select name="category" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-lg text-slate-900 font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all" required>
                                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category</option>
                                    <option value="Power Tools" {{ old('category') == 'Power Tools' ? 'selected' : '' }}>⚡ Power Tools</option>
                                    <option value="Hand Tools" {{ old('category') == 'Hand Tools' ? 'selected' : '' }}>🔧 Hand Tools</option>
                                    <option value="Gardening" {{ old('category') == 'Gardening' ? 'selected' : '' }}>🌿 Gardening</option>
                                    <option value="Cleaning" {{ old('category') == 'Cleaning' ? 'selected' : '' }}>🧹 Cleaning</option>
                                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>
                                </select>
                                @error('category') <p class="text-base text-red-500 mt-2 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-600 uppercase tracking-widest mb-3">Price per Day <span class="text-violet-600">*</span></label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-lg font-bold text-slate-400 pointer-events-none">₸</span>
                                    <input type="number" name="price_per_day" value="{{ old('price_per_day') }}" placeholder="2500" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-12 pr-16 py-4 text-lg text-slate-900 font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all" required>
                                    <span class="absolute right-6 top-1/2 -translate-y-1/2 text-base font-bold text-slate-400">KZT</span>
                                </div>
                                @error('price_per_day') <p class="text-base text-red-500 mt-2 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[32px] border border-slate-200/60 overflow-hidden mb-8 shadow-sm">
                    <div class="flex items-center gap-5 p-8 sm:px-12 sm:py-8 border-b border-slate-100">
                        <div class="w-16 h-16 rounded-2xl bg-violet-50 flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10"/></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Description</h3>
                            <p class="text-base text-slate-500 mt-1">Help renters understand your tool</p>
                        </div>
                        <span class="ml-auto text-base font-bold text-violet-600 bg-violet-50 px-5 py-2 rounded-full">Step 2 of 3</span>
                    </div>
                    <div class="p-8 sm:p-12">
                        <label class="block text-sm font-bold text-slate-600 uppercase tracking-widest mb-3">About this tool <span class="text-violet-600">*</span></label>
                        <textarea name="description" rows="6" placeholder="Describe the tool's condition, what it's best suited for…" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-5 text-lg text-slate-900 font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all resize-none" required>{{ old('description') }}</textarea>
                        <p class="text-sm text-slate-400 mt-3 font-medium">Tip: Listings with detailed descriptions rent 3× faster.</p>
                        @error('description') <p class="text-base text-red-500 mt-2 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="bg-white rounded-[32px] border border-slate-200/60 overflow-hidden mb-10 shadow-sm">
                    <div class="flex items-center gap-5 p-8 sm:px-12 sm:py-8 border-b border-slate-100">
                        <div class="w-16 h-16 rounded-2xl bg-violet-50 flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tool Photo</h3>
                            <p class="text-base text-slate-500 mt-1">A clear photo increases bookings significantly</p>
                        </div>
                        <span class="ml-auto text-base font-bold text-violet-600 bg-violet-50 px-5 py-2 rounded-full">Step 3 of 3</span>
                    </div>
                    <div class="p-8 sm:p-12">
                        <label class="block text-sm font-bold text-slate-600 uppercase tracking-widest mb-3">Upload Image</label>
                        
                        <input type="file" name="image" id="image" accept="image/*" class="hidden" x-ref="fileInput" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                        
                        <div @click="$refs.fileInput.click()" 
                             class="relative border-[3px] border-dashed border-slate-300 rounded-[28px] bg-slate-50 flex flex-col items-center justify-center min-h-[300px] cursor-pointer hover:border-violet-500 hover:bg-violet-50/50 transition-all overflow-hidden group">
                            
                            <div x-show="!imagePreview" class="flex flex-col items-center justify-center py-12">
                                <div class="w-20 h-20 rounded-2xl bg-white border border-slate-200 flex items-center justify-center mb-6 group-hover:bg-violet-100 group-hover:border-violet-300 transition-colors shadow-sm">
                                    <svg class="w-10 h-10 text-slate-400 group-hover:text-violet-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                                </div>
                                <p class="text-xl font-extrabold text-slate-700 group-hover:text-violet-700 tracking-tight">Click to browse or drag photo here</p>
                                <p class="text-base text-slate-400 mt-2 font-medium">PNG, JPG, JPEG · Max 5 MB</p>
                            </div>

                            <div x-show="imagePreview" class="absolute inset-0 w-full h-full" style="display: none;">
                                <img :src="imagePreview" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex items-end justify-between p-8">
                                    <span class="text-white text-lg font-bold flex items-center gap-3">
                                        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Photo Selected
                                    </span>
                                    <button type="button" @click.stop="imagePreview = null; $refs.fileInput.value = ''" class="px-6 py-3 bg-white/20 hover:bg-white/30 backdrop-blur text-white text-base font-bold rounded-xl transition-colors">
                                        Change Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('image') <p class="text-base text-red-500 mt-3 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="bg-white rounded-[32px] border border-slate-200/60 p-8 sm:px-12 flex flex-col-reverse sm:flex-row items-center justify-between gap-6 shadow-sm mb-20">
                    <a href="{{ route('dashboard') }}" class="text-lg font-bold text-slate-500 hover:text-slate-800 flex items-center gap-2 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Cancel & go back
                    </a>
                    
                    <div class="flex items-center gap-8 w-full sm:w-auto">
                        <div class="hidden md:flex items-center gap-2 text-base font-bold text-slate-400">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Secure Submission
                        </div>
                        <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-3 bg-violet-600 hover:bg-violet-700 text-white text-lg font-extrabold py-4 px-10 rounded-2xl shadow-xl shadow-violet-600/30 transition-all transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            Publish Tool
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</x-app-layout>