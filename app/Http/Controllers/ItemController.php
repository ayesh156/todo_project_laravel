<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function index()
    {
        return view('dashboard');
    }

    
    // public function index(Request $request)
    // {
    //     $query = Item::where('user_id', Auth::id());

    //     // Search
    //     if ($search = $request->query('q')) {
    //         $query->search($search);
    //     }

    //     // Filter by active
    //     if ($request->query('active')) {
    //         $query->active();
    //     }

    //     // Sort
    //     $sortBy = $request->query('sortBy', 'id');
    //     $sortAsc = filter_var($request->query('sortAsc', 'true'), FILTER_VALIDATE_BOOLEAN);
    //     $query->orderBy($sortBy, $sortAsc ? 'asc' : 'desc');

    //     $items = $query->paginate(10)->withQueryString(); // preserves query params in pagination

    //     return view('items.index', compact('items', 'sortBy', 'sortAsc'));
    // }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('message', 'Item deleted.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->only(['title', 'description', 'status']);
        $data['user_id'] = Auth::id();

        Item::create($data);

        return redirect()->route('items')->with('message', 'Item created successfully!');
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $item->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('items')->with('message', 'Item updated successfully!');
    }
}
