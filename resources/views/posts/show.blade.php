@extends('layouts.app')

@section('title', 'Post')
@section('content')

    <div class="post mt-5">
        <div class="post-info border mb-3 p-3">
            <h3 class="alert alert-secondary">Post Info:</h3>
            <h4 class="alert py-0 my-0">Post Title: <span class="text-primary">{{ $post->title }}</span></h4>
            <h4 class="alert">
                Post Description:
                 <p class="text-primary">{{ $post->details }}</p>
            </h4>
        </div>

        <div class="creator-info border mb-3 p-3">
            <h3 class="alert alert-secondary">Post Creator Info:</h3>
            <h4 class="alert m-0 mb-2 p-0">Name: <span class="text-primary">{{ $post->user->name }}</span></h4>
            <h4 class="alert m-0 mb-2 p-0">
                Email: <span class="text-primary">{{ $post->user->email }}</span>
            </h4>
            <h4 class="alert m-0 mb-2 p-0">
                Created At: <span class="text-primary">
                    <span class="text-primary">{{ $post->created_at->format('Y/m/d') }}</span>
                    <span class="text-success">{{ $post->created_at->format('H:i:s') }}</span>
                </span>
            </h4>
            <h4 class="alert m-0 mb-2 p-0">
                Last Updated: <span class="text-primary">
                    <span class="text-primary">{{ $post->updated_at->format('Y/m/d') }}</span>
                    <span class="text-success">{{ $post->updated_at->format('H:i:s') }}</span>
                </span>
            </h4>
        </div>
        <div class="creator-info border mb-3 p-3">
            <h4 class="alert m-0 mb-2 p-0">
            Post Image
            </h4>
            <img width="300" src="{{asset('images/posts/'.$post->image)}}" alt="post image">
        </div>
        <a class="btn btn-warning mb-3" href="{{ route('posts.edit', $post->slug) }}">Edit Post</a>
    </div>
@endsection
