<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Tools Catalog</h1>
                    <p class="text-lg text-slate-500 mt-2 font-medium">Find the perfect tool for your next project</p>
                </div>
                
                @auth
                    <a href="{{ route('items.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white text-base font-bold rounded-xl shadow-lg shadow-violet-600/20 transition-all transform hover:-translate-y-0.5 shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        List a Tool
                    </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($items as $item)
                    <a href="{{ route('items.show', $item) }}" class="group bg-white rounded-[28px] overflow-hidden shadow-sm border border-slate-200/60 hover:shadow-2xl hover:shadow-violet-500/10 hover:border-violet-200 transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                        
                        <div class="relative h-[280px] bg-slate-100 overflow-hidden shrink-0">
                            @if($item->image_path)
                                <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 left-4 bg-white/95 backdrop-blur px-3 py-1.5 rounded-full shadow-sm border border-slate-100/50">
                                <span class="text-xs font-black tracking-wider text-violet-700 uppercase">{{ $item->category }}</span>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-2xl font-bold text-slate-900 mb-2 group-hover:text-violet-600 transition-colors line-clamp-1">{{ $item->title }}</h2>
                            <p class="text-slate-500 text-sm font-medium line-clamp-2 mb-6 flex-grow">{{ $item->description }}</p>
                            
                            <div class="flex items-end justify-between pt-4 border-t border-slate-100 mt-auto">
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Price</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-2xl font-black text-slate-900">{{ $item->price_per_day }} ₸</span>
                                        <span class="text-sm font-bold text-slate-500">/ day</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-slate-500">{{ $item->user->name }}</span>
                                    @if($item->user->avatar)
                                        <img src="{{ Storage::url($item->user->avatar) }}" class="w-8 h-8 rounded-full object-cover shadow-sm border border-slate-200">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center text-violet-700 font-black text-xs shadow-sm">
                                            {{ strtoupper(mb_substr($item->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 px-6 text-center border-2 border-dashed border-slate-200 rounded-[32px] bg-white">
                        <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm border border-slate-100">
                            <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-2 tracking-tight">No tools available yet</h3>
                        <p class="text-lg text-slate-500 max-w-lg mx-auto font-medium mb-6">Be the first to list a tool and start earning money today!</p>
                        @auth
                            <a href="{{ route('items.create') }}" class="inline-flex items-center px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white font-bold rounded-xl transition-all shadow-md shadow-violet-600/20">List Your Tool</a>
                        @endauth
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $items->links() }}
            </div>

        </div>
    </div>
</x-app-layout>