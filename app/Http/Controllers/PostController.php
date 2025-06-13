<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        return view('include.post-create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:300|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:1024',
            'body' => 'required|max:2000|string',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/images/'); // Save in public folder
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/images/' . $fileName; 
        }

        Post::create($data);
        return back()->with('success', 'Post has been created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('include.post-edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
         $data = $request->validate([
            'title' => 'required|max:300|string',
            'image' => 'sometimes|mimes:png,jpg,jpeg,webp|max:1024',
            'body' => 'required|max:2000|string',
        ]);

        if ($request->hasFile('image')) {

            //check old image
            $destination = $post->image;

            // remove old image
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/images/'); // Save in public folder
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/images/' . $fileName; 
        }

        $post->update($data);
        return redirect()->route('post.create')->with('success','Post has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {

            //check old image
            $destination = $post->image;

            // remove old image
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $post->delete();
            return back()->with('success', 'Post has been deleted');
        }
    }
}
