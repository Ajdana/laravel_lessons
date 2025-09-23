В нашем контролере много чего написано . Это нарушение общепринятых норм , правил морали . Почему ? Когда наш проект становится очень большим . Если все будет находится в одном контролере будет очень большая путаница . И нам нужно это куда то вынести работу модели . Чтобы они у нас вместе не стояли . Для этого и есть services . Это обще принятый концепт в разработке на php . 

![[Pasted image 20250923172225.png]]

1 . Для этого создаем в App папку services . 
2 . Внутри мы создаем подпапку Post . Но это не обязательно так как в этом примере мы работаем с постами называем пост .
3 . Внутри этой папки создаем php class Service 
4 . Для того чтобы подключить seervice к нашим контролерам . Мы создаем BaseController . Внутри него создаем конструктор .
```php
class BaseController extends Controller  
{  
    public $service;  
  
    public function __construct(Service $service)  
    {  
        $this->service = $service;  
    }  
}
```

5 . После чего мы меняем в наших контроллерах extends Controller на extends BaseController

```php
class CreateController extends BaseController  
{  
    public function __invoke()  
    {  
        $categories = Category::all();  
        $tags = Tag::all();  
        return view('post.create', compact('categories', 'tags'));  
    }  
}
```

6 . После чего переносим с нужных нам контролеров в BaseController 

```php
class Service  
{  
    public function store($data)  
    {  
        $tags = $data['tags'] ?? [];  
        unset($data['tags']);  
        $post = Post::create($data);  
        $post->tags()->attach($tags);  
  
    }  
  
    public function update($post, $data)  
    {  
        $tags = $data['tags'] ?? [];  
        unset($data['tags']);  
  
        $post->update($data);  
        $post->tags()->sync($tags);  
    }  
}
```