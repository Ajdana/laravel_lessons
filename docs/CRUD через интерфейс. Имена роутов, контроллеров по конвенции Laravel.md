## 1. Миграции и модель

### Создание миграции и модели

```bash
php artisan make:model Post -m
```

- `Post` — модель.
    
- `-m` — создаёт миграцию.
    

### Пример миграции `create_posts_table`

```php
public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->timestamps();
    });
}
```

Применение:

```bash
php artisan migrate
```

---

## 2. Маршруты

В `routes/web.php`:

```php
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);
```

📌 Это автоматически создаст 7 маршрутов:

|HTTP метод|URI|Метод контроллера|Название маршрута|
|---|---|---|---|
|GET|/posts|index|posts.index|
|GET|/posts/create|create|posts.create|
|POST|/posts|store|posts.store|
|GET|/posts/{post}|show|posts.show|
|GET|/posts/{post}/edit|edit|posts.edit|
|PUT/PATCH|/posts/{post}|update|posts.update|
|DELETE|/posts/{post}|destroy|posts.destroy|
1.Получение списка 
2.Интерфейс создания
3.Фотки 
4.Получение одного из списка
5.Редактирование
6.Реализация обновления
7.Удаление
---

## 3. Контроллер

Создаём контроллер:

```bash
php artisan make:controller PostController --resource
```

Пример `PostController.php`:

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 1. Список постов
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // 2. Форма создания
    public function create()
    {
        return view('posts.create');
    }

    // 3. Сохранение нового поста
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create($validated);
        return redirect()->route('posts.index')->with('success', 'Пост создан!');
    }

    // 4. Просмотр поста
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5. Форма редактирования
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 6. Обновление
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);
        return redirect()->route('posts.index')->with('success', 'Пост обновлён!');
    }

    // 7. Удаление
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост удалён!');
    }
}
```

---

## 4. Blade-шаблоны

### `resources/views/posts/index.blade.php`

```blade
@extends('layouts.app')

@section('content')
    <h1>Список постов</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Создать пост</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Редактировать</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
```

---

### `resources/views/posts/create.blade.php`

```blade
@extends('layouts.app')

@section('content')
    <h1>Создать пост</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label>Заголовок:</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Контент:</label>
            <textarea name="content">{{ old('content') }}</textarea>
            @error('content') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit">Сохранить</button>
    </form>
@endsection
```

---

### `resources/views/posts/edit.blade.php`

```blade
@extends('layouts.app')

@section('content')
    <h1>Редактировать пост</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Заголовок:</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
        </div>
        <div>
            <label>Контент:</label>
            <textarea name="content">{{ old('content', $post->content) }}</textarea>
        </div>
        <button type="submit">Обновить</button>
    </form>
@endsection
```

---

### `resources/views/posts/show.blade.php`

```blade
@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <a href="{{ route('posts.index') }}">Назад к списку</a>
@endsection
```

---

## 5. Модель Post

В `app/Models/Post.php`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content'];
}
```

---

## 6. Структура проекта (важные файлы)

```
app/
 └── Http/
      └── Controllers/
           └── PostController.php
app/
 └── Models/
      └── Post.php
resources/
 └── views/
      └── posts/
           ├── index.blade.php
           ├── create.blade.php
           ├── edit.blade.php
           └── show.blade.php
routes/
 └── web.php
database/
 └── migrations/
      └── xxxx_xx_xx_xxxxxx_create_posts_table.php
```

---
