<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MyPostController extends Controller
{
    public function index() {
//        $posts = Post::all();
//        foreach ($posts as $post) {
//            dump($post->title);
//        }
//        dd('end');
        $post = Post::where('is_published', 1)->first();
        dump($post->title);
        dd('end');
    }

    public function create()
    {
        $postsArr = [
            [
                'title' => 'title of post from phpstorm',
                'content' => 'some interesting content',
                'image' => 'imageblabla.jpg',
                'likes' => 20,
                'is_published' => 1,
            ],
            [
                'title' => 'another title of post from phpstorm',
                'content' => 'another some interesting content',
                'image' => 'another imageblabla.jpg',
                'likes' => 50,
                'is_published' => 1,
            ],
        ];

        foreach ($postsArr as $item) {
            Post::create([
                'title' => $item['title'],
                'content' => $item['content'],
                'image' => $item['image'],
                'likes' => $item['likes'],
                'is_published' => $item['is_published'],
            ]);
        }
        dd('created');
//        Post::create([
////            'title' => 'another title of post from phpstorm',
////            'content' => 'another some interesting content',
////            'image' => 'another imageblabla.jpg',
////            'likes' => 50,
////            'is_published' => 1,
//        ]);
    }

    public function update(){
        $post = Post::find(6);
        $post->update([
            'title' => '1111 updated',
            'content' => '1111 updated',
        ]);
        dd('updated');
    }

    public function delete(){
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted');
    }
}
