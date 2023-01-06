<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        return Inertia::render("Blog/Index", [
            'pageTitle' => 'Blog',
            'posts'     => Post::all()
        ]);
    }

    public function edit($slug) {
        $post = Post::where('slug', $slug)->firstOrFail();

        return Inertia::render("Blog/Edit", [
            'post' => $post
        ]);
    }

    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name'      => 'required',
            'slug'      => 'required|unique:posts,slug,' . $post->id,
            'content'   => 'required',
            'published' => 'required'
        ]);

        $post->update($request->only(['name', 'slug', 'content', 'published']));

        return redirect()->route('blog.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'slug'      => 'required|unique:posts',
            'content'   => 'required',
            'published' => 'required'
        ]);

        Post::create($request->only(['name', 'slug', 'content', 'published']));

        return redirect()->route('blog.index');
    }

    public function create()
    {
        return Inertia::render("Blog/Create");
    }

    public function toggle($id)
    {
        $post = Post::findOrFail($id);

        $post->published = !$post->published;;

        $post->save();
    }

}
