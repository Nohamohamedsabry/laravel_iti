@extends('layouts.app')

@section('title', 'Edit post')
@section('content')

    <h2 class="text-center mt-5 text-warning">Edit post</h2>
    <form method="POST" action="{{ route('posts.update', $post->slug) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Post Title"
                value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Description</label>
            <textarea class="form-control" name="details" id="" cols="30" rows="5">{{ $post->details }}</textarea>
        </div>
        <div class="mb-3">
            <label for="posted_by" class="form-label">Post Creator:</label>
            <select class="form-select" name="user_id">
                @foreach ($users as $user)
                    <option @if ($post->user_id == $user->id) selected @endif value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date of post</label>
            <input type="text" class="form-control" id="date" placeholder="Date of post"
                value="{{ $post->created_at }}">
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Last update</label>
            <input type="text" class="form-control" id="date" placeholder="Date of post"
                value="{{ $post->updated_at }}">
        </div>



        <div class="mb-3">
            <label class="form-label">Post Image</label>
            <div class="mb-2">
                <img width="300" src="{{asset('images/posts/'.$post->image)}}" alt="post image">
            </div>
            <label for="date" class="form-label">Change image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="my-2 btn btn-outline-warning">
            Update Post
        </button>
    </form>
@endsection
