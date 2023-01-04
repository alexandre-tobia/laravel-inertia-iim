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

    public function store(Request $request) {

        Post::create($request->all());

        return redirect()->back();
    }
}
