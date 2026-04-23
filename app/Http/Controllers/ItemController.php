<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\ItemStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ItemController extends Controller
{
    public function index(): View
    {
        $items = Item::with('user')
            ->where('user_id', '!=', Auth::id())
            ->latest()
            ->paginate(12);

        return view('items.index', compact('items'));
    }

    public function create(): View
    {
        return view('items.create');
    }

    public function store(ItemStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        Auth::user()->items()->create($validated);

        return redirect()->route('items.index')->with('status', 'Tool listed successfully!');
    }

    public function show(Item $item): View
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item): View
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }
        return view('items.edit', compact('item'));
    }

    public function update(ItemStoreRequest $request, Item $item): RedirectResponse
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('items.index')->with('status', 'Item updated!');
    }

    public function destroy(Item $item): RedirectResponse
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('items.index')->with('status', 'Item removed!');
    }
}