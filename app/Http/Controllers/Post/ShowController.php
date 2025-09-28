<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

//ctrl + alt + o удаляет ненужные пути

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        return new PostResource($post);
//        return view('post.show', compact('post'));
    }
}
