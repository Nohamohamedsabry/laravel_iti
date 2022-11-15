<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Jobs\PruneOldPosts;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function create()
    {
        $users = User::all('id', 'name');
        return view('posts.create', compact('users'));
    }

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function store(StorePostRequest $request)
    {
        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $imageEx = $image->extension();
            $imageName = request()->title . time() . "." . $imageEx;
            $path = public_path('\images\posts');
            $image->move($path, $imageName);
        } else {
            $imageName = 'default.png';
        }
        $formData = request()->all();
        $formData['image'] = $imageName;
        Post::create($formData);
        return to_route('posts.create')->with('message', 'Created successfully');
    }

    public function edit($slug)
    {
        $post = Post::withTrashed()->where('slug', $slug)->get()->first();
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }


    public function show($slug)
    {
        $post = Post::withTrashed()->where('slug', $slug)->get()->first();
        return view('posts.show', compact('post'));
    }

    public function update(UpdatePostRequest $request, $slug)
    {
        $post = Post::withTrashed()->where('slug', $slug)->get()->first();
        $oldImage = $post->image;

        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $imageEx = $image->extension();
            $imageName = request()->title . time() . "." . $imageEx;
            $path = public_path('\images\posts');
            $image->move($path, $imageName);

            if ($oldImage !== 'default.png') {
                $image_path =  public_path('images/posts/' . $oldImage);
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
            }
        } else {
            $imageName = $oldImage;
        }

        $formData = request()->all();
        $formData['image'] = $imageName;
        $post->title = request()->title;
        $post->slug = Str::slug($post->title);
        $slug = $post->slug;
        $post->details = request()->details;
        $post->image =  $imageName;
        $post->user_id = request()->user_id;
        $post->save();
        return to_route('posts.edit', $slug)->with('message', 'Updated successfully');
    }


    public function deleted()
    {
        $posts = Post::onlyTrashed()->orderBy('updated_at', 'DESC')->paginate(10);
        return view('posts.deleted', compact('posts'));

    }

    public function deleteOld()
    {
        PruneOldPosts::dispatch();
        return to_route('posts.deleted')->with('message', 'Old post will be deleted');

    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return to_route('posts.index')->with('message', 'Deleted successfully');
    }

    public function deleteNotRestored($id)
    {
        $post = Post::withTrashed()->where('id', $id)->get()->first();
        $oldImage = $post->image;
        $post->forceDelete();
        if ($oldImage !== 'default.png') {
            $image_path =  public_path('images/posts/' . $oldImage);
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
        }
        return to_route('posts.deleted')->with('message', 'Deleted successfully');
    }

    public function restore($id)
    {
        Post::where('id', $id)->restore();
        return to_route('posts.deleted')->with('message', 'Restored successfully');
    }
}
