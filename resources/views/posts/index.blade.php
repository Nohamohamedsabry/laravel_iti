@extends('layouts.app')

@section('title', 'Home')


@section('content')

    <h1 class="mt-5 text-center text-secondary">All Posts</h1>
    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create Post</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Posted By</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $post)
                <tr>
                    <th scope="row">{{ $posts->firstItem() + $key }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->updated_at->format('Y/m/d')}}</td>
                    <td class="d-flex gap-3">
                        <a class="btn btn-sm btn-secondary" title="show" href="{{ route('posts.show', $post->slug) }}"><i
                                class="fa-regular fa-eye"></i></a>
                        <a class="btn btn-sm btn-warning" title="edit" href="{{ route('posts.edit', $post->slug) }}"><i
                                class="fa-regular fa-pen-to-square"></i></a>
                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('are you sure?')"
                                title="delete"><i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
    @endsection
