Чтобы создать request в laravel 

```php
php artisan make:request \\name of request
```

Чтобы наш request работал нам нужно убрать 

```php
public function authorize()  
{  
    return false;\\-убрать false и написать true  
}
```

Как мы указываем request

```php
public function __invoke(UpdateRequest $request, Post $post ) \\ указываем точно где находится
{  
    $data = request()->validated();  
    $tags = $data['tags'] ?? [];  
    unset($data['tags']);  
  
    $post->update($data);  
    $post->tags()->sync($tags);  
    return redirect()->route('post.show', $post->id);  
}
```