<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

//ctrl + alt + o удаляет ненужные пути

class UpdateController extends Controller
{
    public function __invoke(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => 'integer',
            'tags' => 'array',
            'tags.*' => 'integer',

        ]);
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }
}
