<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Faker\Provider\Base;

//ctrl + alt + o удаляет ненужные пути

class IndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }
}
