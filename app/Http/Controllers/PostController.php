<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = [
            ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
            ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
        ];

        return view('posts.index', [
          'posts' => $allPosts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($postId)
    {
        dd('you are in show');
        // return Redirect()->route('posts.index');
    }

    public function store()
    {
        // dd('we are storing the data');
        return Redirect()->route('posts.index');
    }

    public function edit($postId)
    {
        $allPosts = [
            ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
            ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
        ];

        return view('posts.edit', [
          'posts' => $allPosts
        ]);
    }

    public function update($postId)
    {
        // dd('we are updating the data');
       return Redirect()->route('posts.index');
    }
    public function destroy($postId)
    {

       return "you are deleting this post";
    //    return Redirect()->route('posts.index');
    }

}
