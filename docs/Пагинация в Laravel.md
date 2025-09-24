Что такое Пагинация и для чего она нужна ?
Пагинация - снижает нагрузку на сайт . То есть если у нас сразу подгружает большое кол-во постов . Это будет очень сильно подгружать работу . 

Как работаем с paginate ? 

```php
public function __invoke()  
{  
    $posts = Post::paginate(10);  
    return view('post.index', compact('posts'));  
}
```

Вместо post ставим метод paginate . И в скобках можем указать какое кол-во страниц мы хотим загрузить . 

После чего в шаблоне blade 

```php
  
<div class="mt-3">  
    {{$posts->links()}}  
</div>
```

указываем ссылки на посты

Чтобы активировать шаблоны бутстрапа мы используем данную команду:

```php
php artisan vendor:publish --tag=laravel-pagination
```

Чтобы переключить с тайлвинд на бутстрап . Мы в AppServiceProvider в метод boot . Указываем

```php
Paginator::defaultView('vendor.pagination.bootstrap-4');
```