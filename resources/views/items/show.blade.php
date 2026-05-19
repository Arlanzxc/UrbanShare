<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('items.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 mb-6 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to catalog
            </a>

            <div class="bg-white overflow-hidden shadow-xl shadow-gray-200/50 sm:rounded-3xl p-8 border border-gray-100">
                <div class="flex flex-col lg:flex-row gap-12">
                    
                    <div class="lg:w-2/3">
                        <div class="relative group rounded-3xl overflow-hidden shadow-md">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-[450px] object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                            @else
                                <div class="w-full h-[450px] bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-gray-500 font-medium text-lg">No Image Provided</span>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-indigo-800 text-xs px-4 py-2 rounded-full font-bold uppercase tracking-wider shadow-sm">
                                {{ $item->category }}
                            </div>
                        </div>

                        <div class="mt-10">
                            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $item->title }}</h1>
                            <div class="flex items-center gap-4 mt-4 pb-8 border-b border-gray-100">
                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                                        {{ substr($item->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Owned by</p>
                                        <p class="text-md font-bold text-gray-900">{{ $item->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">About this tool</h3>
                                <p class="text-gray-600 leading-relaxed text-lg">{{ $item->description }}</p>
                            </div>
                        </div>

                        <div class="mt-12 bg-gray-50 rounded-3xl p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                User Reviews
                            </h3>
                        
                            <div class="space-y-6">
                                @forelse($item->reviews as $review)
                                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold text-xs">
                                                    {{ substr($review->user->name, 0, 1) }}
                                                </div>
                                                <span class="text-gray-900 font-bold">{{ $review->user->name }}</span>
                                            </div>
                                            <span class="text-yellow-400 text-sm tracking-widest">{{ str_repeat('★', $review->rating) }}<span class="text-gray-200">{{ str_repeat('★', 5 - $review->rating) }}</span></span>
                                        </div>
                                        <p class="text-gray-600 italic">"{{ $review->comment }}"</p>
                                        <p class="text-gray-400 text-xs mt-3 font-medium uppercase tracking-wider">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <p class="text-gray-500 font-medium">No reviews yet. Be the first to rent and review!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-1/3">
                        <div class="bg-white p-8 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-gray-100 sticky top-28">
                            <div class="mb-6 flex items-end gap-1">
                                <span class="text-4xl font-extrabold text-gray-900">{{ $item->price_per_day }} ₸</span>
                                <span class="text-gray-500 font-medium mb-1">/ day</span>
                            </div>

                            @auth
                                @if(auth()->id() !== $item->user_id)
                                    <form action="{{ route('bookings.store', $item) }}" method="POST" class="space-y-5">
                                        @csrf
                                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-200">
                                            <div class="mb-4">
                                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Start Date</label>
                                                <input type="date" name="start_date" min="{{ date('Y-m-d') }}" class="w-full bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition" required />
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">End Date</label>
                                                <input type="date" name="end_date" min="{{ date('Y-m-d') }}" class="w-full bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition" required />
                                            </div>
                                        </div>

                                        @if($errors->has('dates'))
                                            <div class="p-3 bg-red-50 text-red-600 text-sm rounded-xl font-medium flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $errors->first('dates') }}
                                            </div>
                                        @endif

                                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-indigo-500/30 transform hover:-translate-y-0.5 transition duration-200 text-lg">
                                            Rent Now
                                        </button>
                                    </form>
                                    <div class="mt-6 text-center">
                                        <p class="text-sm text-gray-500 font-medium flex items-center justify-center gap-1">
                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                            You won't be charged yet
                                        </p>
                                    </div>
                                @else
                                    <div class="bg-indigo-50 border border-indigo-100 p-6 rounded-2xl text-center">
                                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <p class="font-bold text-indigo-900 mb-1">This is your listing</p>
                                        <p class="text-sm text-indigo-700">Manage it from your dashboard.</p>
                                    </div>
                                @endif
                            @else
                                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 text-center">
                                    <h4 class="font-bold text-gray-900 mb-2">Want to rent this?</h4>
                                    <p class="text-sm text-gray-500 mb-6">Join UrbanShare to easily rent tools from people nearby.</p>
                                    <div class="space-y-3">
                                        <a href="{{ route('login') }}" class="block w-full bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-3 px-4 rounded-xl transition shadow-sm">Log In</a>
                                        <a href="{{ route('register') }}" class="block w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm">Sign Up</a>
                                    </div>
                                </div>
                            @endauth

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>