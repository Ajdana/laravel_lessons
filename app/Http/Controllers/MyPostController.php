<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MyPostController extends Controller
{
    public function index() {
        $posts = Post::all();
        dump($posts);
        echo 'aaaaa';
    }
}
