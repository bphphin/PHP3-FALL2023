<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'posts.';
    private const IMAGE_PATH = 'posts';
    public function index()
    {
        $data = Post::latest()->paginate(10);
        return view(self::VIEW_PATH.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_PATH.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50|unique:posts',
            'image' => 'image|file:max:1042',
            'status' => [
                'required',
                Rule::in([
                    Post::STATUS_DRAFF,
                    Post::STATUS_PUBLISHED,
                ]),
            ],
        ]);
        $data = $request->except('image');
        if($request->hasFile('image')) {
            $data['image'] = Storage::put(self::IMAGE_PATH,$request->file('image'));
        }
        Post::create($data);
        Alert::success('Successfully','Created Post Successfully');
        return redirect()->route('post.index');
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
        return view(self::VIEW_PATH.__FUNCTION__,compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:50|unique:posts,title,'.$post->id,
            'image' => 'image|file:max:1042',
            'status' => [
                'required',
                Rule::in([
                    Post::STATUS_DRAFF,
                    Post::STATUS_PUBLISHED,
                ]),
            ],
        ]);
        $data = $request->except('image');
        if($request->hasFile('image')) {
            $data['image'] = Storage::put(self::IMAGE_PATH,$request->file('image'));
        }
        $oldPathImg = $post->image;
        $post->update($data);
        if($request->hasFile('image')) {
            Storage::delete($oldPathImg);
        }
        Alert::success('Successfully','Updated Post Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
        }
        $post->delete();
        Alert::success('Successfully','Deleted Post Successfully');
        return back();
    }
}