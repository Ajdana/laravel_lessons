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
}
