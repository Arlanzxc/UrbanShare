<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $item->title }} Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-2/3">
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" class="rounded-xl w-full h-[400px] object-cover border border-gray-100">
                        @else
                            <div class="rounded-xl w-full h-[400px] bg-gray-100 flex items-center justify-center">
                                <span class="text-gray-400">No Image Provided</span>
                            </div>
                        @endif

                        <div class="mt-6">
                            <h1 class="text-3xl font-extrabold text-gray-900">{{ $item->title }}</h1>
                            <div class="flex items-center gap-4 mt-2 mb-6">
                                <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full font-semibold uppercase">{{ $item->category }}</span>
                                <span class="text-gray-500 text-sm">Owner: {{ $item->user->name }}</span>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Description</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $item->description }}</p>
                        </div>
                    </div>

                    <div class="md:w-1/3">
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 sticky top-6">
                            <div class="mb-6 border-b border-gray-200 pb-4">
                                <span class="text-3xl font-extrabold text-gray-900">{{ $item->price_per_day }} ₸</span>
                                <span class="text-gray-500">/ day</span>
                            </div>

                            <form action="{{ route('bookings.store', $item) }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="start_date" value="Start Date" />
                                        <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" required />
                                    </div>
                                    <div>
                                        <x-input-label for="end_date" value="End Date" />
                                        <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" required />
                                    </div>
                                </div>

                                @if($errors->has('dates'))
                                    <p class="mt-3 text-sm text-red-600 font-medium">{{ $errors->first('dates') }}</p>
                                @endif

                                <button type="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150">
                                    Request Booking
                                </button>
                            </form>
                            
                            <p class="text-xs text-center text-gray-500 mt-4">You won't be charged yet. The owner needs to approve your request.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>