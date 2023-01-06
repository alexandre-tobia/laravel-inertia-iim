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

    public function create() {
        return Inertia::render("Blog/Create");
    }

    public function toggle($id) {
        $post = Post::findOrFail($id);

        $post->published = !$post->published;;

        $post->save();
    }

}
