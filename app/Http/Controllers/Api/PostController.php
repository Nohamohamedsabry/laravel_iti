<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->paginate(5);
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request)
    {
        $post =  Post::create([
            'title' => $request->title,
            'details' => $request->details,
            'user_id' => $request->user_id
        ]);

        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);
    }
}
