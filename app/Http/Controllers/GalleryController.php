<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $files = Storage::files('public/gallery');

        $images = array_map(function ($file) {
            return Storage::url($file);
        }, $files);

        return view('livewire.gallery', compact('images'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

       $request->file('image')->store('gallery', 'public');

        return redirect()->route('gallery')->with('message', 'Image uploaded successfully!');
    }
}
