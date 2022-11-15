@extends('layouts.app')

@section('title', 'Create post')
@section('content')


    <h2 class="text-center mt-5 text-primary">Create New Post</h2>
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Post Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="" value="">
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">Post Description</label>
        <textarea class="form-control" name="details" id="" cols="30" rows="5"></textarea>
      </div>
      <div class="mb-3">
        <label for="posted_by" class="form-label">Post Creator:</label>
        <select class="form-select" name="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Post Image</label>
      <input type="file" class="form-control" name="image" id="image">
    </div>
      <button type="submit" class="mt-3 btn btn-outline-primary">
            Create Post
      </button>
    </form>
@endsection
