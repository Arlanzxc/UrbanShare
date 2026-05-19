<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                    Dashboard
                </h1>
                <p class="text-base text-slate-500 mt-2 font-medium">Your tool management hub</p>
            </div>

            @if(session('status'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition.opacity.duration.500ms class="mb-8 p-5 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <p class="text-emerald-800 font-bold text-lg">{{ session('status') }}</p>
                </div>
            @endif

            <div class="space-y-8">
                
               {{-- My Tools --}}
                <section class="bg-white rounded-[24px] shadow-sm border border-slate-200/60 p-8 sm:p-10">
                    <div class="flex items-center justify-between mb-8 pb-5 border-b border-slate-100">
                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">My Listed Tools</h2>

                        <a href="{{ route('items.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white text-base font-bold rounded-xl shadow-md shadow-violet-600/20 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            List a Tool
                        </a>
                    </div>

                    @forelse($myItems as $item)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-6 mb-4 border border-slate-100 rounded-2xl hover:border-violet-200 transition-colors bg-slate-50/50 gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">{{ $item->title }}</h3>
                                <p class="text-base font-medium text-slate-500 mt-1">Price: <span class="text-slate-800 font-bold">{{ $item->price_per_day }} ₸</span> / day</p>
                                <span class="inline-flex mt-2 items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-violet-100 text-violet-800">
                                    {{ $item->category }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                <a href="{{ route('items.show', $item) }}" class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors shadow-sm">
                                    View
                                </a>

                                <a href="{{ route('items.edit', $item) }}" class="px-4 py-2.5 bg-amber-50 border border-amber-200 rounded-xl text-sm font-bold text-amber-700 hover:bg-amber-500 hover:text-white transition-colors shadow-sm">
                                    Edit
                                </a>
                            
                                <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tool?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2.5 bg-rose-50 border border-rose-200 rounded-xl text-sm font-bold text-rose-600 hover:bg-rose-500 hover:text-white transition-colors shadow-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="py-16 px-6 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/60">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-slate-100">
                                <svg class="w-10 h-10 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 01-1-1V4a1 1 0 011-1h3a1 1 0 001-1v-1z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-extrabold text-slate-800 mb-3 tracking-tight">Start Earning with Your Idle Tools</h3>
                            <p class="text-lg text-slate-500 max-w-2xl mx-auto font-medium leading-relaxed">Why buy a tool you'll use once? List your first item today and earn extra money by renting to your neighbors.</p>
                        </div>
                    @endforelse
                </section>

                {{-- Requests --}}
                <section class="bg-white rounded-[24px] shadow-sm border border-slate-200/60 p-8 sm:p-10">
                    <div class="flex items-center gap-4 mb-8 pb-5 border-b border-slate-100">
                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Incoming Rental Requests</h2>
                        <span class="inline-flex items-center justify-center px-3 py-1 text-sm font-bold text-slate-600 bg-slate-100 rounded-full">{{ $incomingRequests->count() }}</span>
                    </div>

                    @forelse($incomingRequests as $booking)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-6 mb-4 border border-slate-100 rounded-2xl bg-slate-50/50">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Request for: <span class="text-violet-600">{{ $booking->item->title ?? 'Tool' }}</span></h3>
                                <p class="text-sm font-medium text-slate-500 mt-1 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }} — {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                </p>
                                <p class="mt-3 inline-flex items-center px-3 py-1 text-xs font-bold rounded-full 
                                    {{ $booking->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($booking->status === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                                    {{ strtoupper($booking->status) }}
                                </p>
                            </div>
                        
                            @if($booking->status === 'pending')
                                <div class="flex items-center gap-3 mt-5 sm:mt-0">
                                    <form action="{{ route('bookings.approve', $booking) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl transition-colors">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('bookings.reject', $booking) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-5 py-2.5 bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-500 hover:text-white font-bold rounded-xl transition-colors">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="py-14 px-6 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/60">
                            <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-5 shadow-sm border border-slate-100">
                                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800 mb-2 tracking-tight">Your Tools are in High Demand!</h3>
                            <p class="text-lg text-slate-500 max-w-lg mx-auto font-medium">New rental requests will appear here. Get ready to approve your first booking.</p>
                        </div>
                    @endforelse
                </section>

                {{-- My Bookings --}}
                <section class="bg-white rounded-[24px] shadow-sm border border-slate-200/60 p-8 sm:p-10">
                    <div class="mb-8 pb-5 border-b border-slate-100 flex items-center gap-4">
                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">My Bookings</h2>
                        <span class="inline-flex items-center justify-center px-3 py-1 text-sm font-bold text-slate-600 bg-slate-100 rounded-full">{{ $myBookings->count() }}</span>
                    </div>
                    
                    @forelse($myBookings as $booking)
                        <div class="flex flex-col p-5 mb-4 border border-slate-100 rounded-2xl bg-slate-50/50 hover:border-violet-200 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $booking->item->title ?? 'Tool' }}</h3>
                                    <p class="text-sm font-medium text-slate-500 mt-1 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} — {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                    </p>
                                </div>
                                <span class="px-4 py-1.5 rounded-full text-xs font-black tracking-wider 
                                    {{ $booking->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($booking->status === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                                    {{ strtoupper($booking->status) }}
                                </span>
                            </div>

                            @if($booking->status === 'approved')
                                <div class="mt-4 pt-4 border-t border-slate-200/60">
                                    
                                    @if(!$booking->review)
                                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Leave a review for owner</p>
                                        <form action="{{ route('reviews.store', $booking) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-3">
                                            @csrf
                                            <select name="rating" class="bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none w-full sm:w-auto" required>
                                                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                                <option value="4">⭐⭐⭐⭐ (4)</option>
                                                <option value="3">⭐⭐⭐ (3)</option>
                                                <option value="2">⭐⭐ (2)</option>
                                                <option value="1">⭐ (1)</option>
                                            </select>
                                            <input type="text" name="comment" placeholder="How was the tool?" class="w-full sm:flex-1 bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition-all" required>
                                            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-violet-600 hover:bg-violet-700 text-white font-bold text-sm rounded-xl transition-colors shadow-md shadow-violet-600/20">
                                                Submit Review
                                            </button>
                                        </form>
                                        
                                    @else
                                        <div class="flex items-center gap-3 bg-slate-50/80 p-3.5 rounded-xl border border-slate-100">
                                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                                                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-800">You reviewed this tool</p>
                                                <p class="text-[13px] font-medium text-slate-500">Your rating: <span class="text-amber-500 tracking-widest">{{ str_repeat('★', $booking->review->rating) }}</span></p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="py-14 px-6 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/60">
                            <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-5 shadow-sm border border-slate-100">
                                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800 mb-2 tracking-tight">Ready to Start Renting?</h3>
                            <p class="text-lg text-slate-500 max-w-lg mx-auto font-medium">All tools you borrow from others will be tracked here. Explore the Catalog to find what you need.</p>
                        </div>
                    @endforelse
                </section>

            </div>
        </div>
    </div>
</x-app-layout>