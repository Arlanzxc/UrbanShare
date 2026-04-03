<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Tool: {{ $item->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="title" value="Tool Name" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ $item->title }}" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="category" value="Category" />
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="Power Tools" {{ $item->category == 'Power Tools' ? 'selected' : '' }}>Power Tools</option>
                                <option value="Hand Tools" {{ $item->category == 'Hand Tools' ? 'selected' : '' }}>Hand Tools</option>
                                <option value="Gardening" {{ $item->category == 'Gardening' ? 'selected' : '' }}>Gardening</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="price_per_day" value="Price per Day (KZT)" />
                            <x-text-input id="price_per_day" name="price_per_day" type="number" step="0.01" class="mt-1 block w-full" value="{{ $item->price_per_day }}" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" value="Description" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $item->description }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="image" value="Update Photo (Leave empty to keep current)" />
                        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700" />
                        @if($item->image_path)
                            <p class="text-sm text-gray-500 mt-2">Current image is active.</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:underline">Cancel</a>
                        <x-primary-button>Save Changes</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>