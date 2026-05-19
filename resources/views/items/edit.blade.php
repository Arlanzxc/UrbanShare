<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-violet-600 font-bold mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Dashboard
            </a>

            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Edit Tool</h1>
                <p class="text-base text-slate-500 mt-2 font-medium">Update the details for <span class="text-violet-600 font-bold">"{{ $item->title }}"</span></p>
            </div>

            <div class="bg-white rounded-[32px] shadow-sm border border-slate-200/60 p-8 sm:p-10">
                <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    @if($errors->any())
                        <div class="p-5 bg-rose-50 border border-rose-100 rounded-2xl">
                            <ul class="list-disc list-inside text-sm font-medium text-rose-600">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label for="title" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Tool Name <span class="text-rose-500">*</span></label>
                        <input id="title" name="title" type="text" value="{{ old('title', $item->title) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-base font-bold text-slate-900 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all" required />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="category" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Category <span class="text-rose-500">*</span></label>
                            <select id="category" name="category" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-base font-bold text-slate-900 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all cursor-pointer" required>
                                <option value="Power Tools" {{ (old('category', $item->category) == 'Power Tools') ? 'selected' : '' }}>Power Tools</option>
                                <option value="Hand Tools" {{ (old('category', $item->category) == 'Hand Tools') ? 'selected' : '' }}>Hand Tools</option>
                                <option value="Gardening" {{ (old('category', $item->category) == 'Gardening') ? 'selected' : '' }}>Gardening</option>
                            </select>
                        </div>
                        <div>
                            <label for="price_per_day" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Price per Day (KZT) <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <input id="price_per_day" name="price_per_day" type="number" step="0.01" value="{{ old('price_per_day', $item->price_per_day) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-4 pr-12 py-3 text-base font-bold text-slate-900 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all" required />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 font-bold">₸</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Description <span class="text-rose-500">*</span></label>
                        <textarea id="description" name="description" rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-base font-medium text-slate-900 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all resize-y" required>{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Tool Photo</label>
                        
                        <div class="flex flex-col sm:flex-row items-start gap-6 bg-slate-50 p-5 rounded-2xl border border-slate-200 border-dashed">
                            
                            @if($item->image_path)
                                <div class="shrink-0 relative group">
                                    <div class="w-24 h-24 rounded-xl overflow-hidden shadow-sm border border-slate-200">
                                        <img src="{{ Storage::url($item->image_path) }}" alt="Current Photo" class="w-full h-full object-cover">
                                    </div>
                                    <span class="absolute -top-2 -right-2 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded-full border-2 border-white shadow-sm">Active</span>
                                </div>
                            @else
                                <div class="shrink-0 w-24 h-24 rounded-xl bg-slate-200 border border-slate-300 flex items-center justify-center text-slate-400 shadow-inner">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif

                            <div class="flex-1 w-full">
                                <p class="text-sm font-bold text-slate-700 mb-1">Upload a new image</p>
                                <p class="text-xs text-slate-500 font-medium mb-3">Leave empty if you want to keep the current photo. Max size: 5MB.</p>
                                
                                <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-violet-100 file:text-violet-700 hover:file:bg-violet-200 transition-all cursor-pointer" />
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-6 py-3.5 text-center text-slate-500 hover:text-slate-800 font-bold transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-violet-600 hover:bg-violet-700 text-white font-extrabold text-base rounded-xl shadow-lg shadow-violet-600/30 transition-all transform hover:-translate-y-0.5">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</x-app-layout>