<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900">My Listed Tools</h3>
                    <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                        + List New Tool
                    </a>
                </div>
                
                @php
                    $myItems = auth()->user()->items;
                @endphp
            
                @if($myItems->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($myItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12">
                                                    @if($item->image_path)
                                                        <img class="h-12 w-12 rounded-lg object-cover border border-gray-200" src="{{ asset('storage/' . $item->image_path) }}" alt="">
                                                    @else
                                                        <div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 text-xs">No img</div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->price_per_day }} ₸/day</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center gap-x-4">
                                                <a href="{{ route('items.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                                
                                                <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this tool?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-10 border-2 border-dashed border-gray-200 rounded-lg">
                        <p class="text-gray-500 text-sm">You haven't listed any tools yet.</p>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Incoming Rental Requests</h3>

                @php
                    $incomingRequests = \App\Models\Booking::whereHas('item', function($query) {
                        $query->where('user_id', auth()->id());
                    })->where('status', 'pending')->with(['user', 'item'])->get();
                @endphp

                @if($incomingRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach($incomingRequests as $request)
                            <div class="flex items-center justify-between p-4 border rounded-lg bg-gray-50">
                                <div>
                                    <p class="font-bold text-indigo-600">{{ $request->user->name }}</p>
                                    <p class="text-sm text-gray-600">wants to rent <strong>{{ $request->item->title }}</strong></p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Period: {{ $request->start_date }} to {{ $request->end_date }}
                                    </p>
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{ route('bookings.approve', $request) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-md text-sm hover:bg-green-600 transition">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('bookings.reject', $request) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm hover:bg-red-600 transition">
                                            Decline
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm italic">No pending requests at the moment.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>