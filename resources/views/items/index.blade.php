<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Available Tools in Your Area
            </h2>
            <a href="{{ route('items.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700 transition">
                + Add Tool
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($items as $item)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="h-48 w-full object-cover">
                        @else
                            <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-400">
                                No Image
                            </div>
                        @endif

                        <div class="p-5 flex-grow flex flex-col">
                            <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">{{ $item->category }}</span>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->title }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $item->description }}</p>
                            
                            <div class="mt-auto flex items-center justify-between">
                                <span class="text-xl font-extrabold text-gray-900">{{ $item->price_per_day }} ₸<span class="text-sm font-normal text-gray-500">/day</span></span>
                                <a href="{{ route('items.show', $item) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">View & Rent &rarr;</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</x-app-layout>