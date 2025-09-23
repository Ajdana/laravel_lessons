<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

//ctrl + alt + o удаляет ненужные пути

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        return view('post.show', compact('post'));
    }
}
