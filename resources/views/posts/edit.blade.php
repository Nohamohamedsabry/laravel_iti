@extends('layouts.app')

@section('title') create @endsection
@section('content')

@foreach ($posts as $post)
    @endforeach
        <form method="POST" action="{{route('posts.update', $post['id'])}}">
        @csrf
          @method('PUT')
           <h1>you are in edit</h1>
            <button type="submit" class="btn btn-primary" >Update</button>
          </form>

@endsection
