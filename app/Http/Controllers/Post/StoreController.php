<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

//ctrl + alt + o удаляет ненужные пути

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $post = $this->service->store($data);
        return new PostResource($post);
//        $arr = [
//            'title' => $post->title,
//            'content' => $post->content,
//            'image' => $post->image,
//        ];
//        return $arr;
//        return redirect()->route('post.index');
    }
}
