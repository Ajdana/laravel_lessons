## 🔹 Установка шаблона

1. Скачиваем AdminLTE с официального сайта (берём **Source Code**).
    
2. Распаковываем архив.
    
3. В Laravel копируем папки:
    
    - `dist` → в `public/`
        
    - `plugins` → в `public/`
        

> Эти папки содержат все нужные стили, скрипты и плагины.

---

## 🔹 Подключение шаблона

1. Создаём `MainController` и маршрут на главную страницу.
    
2. В представлении `main.blade.php` вставляем HTML код из скачанного шаблона.
    
3. Все пути к стилям и скриптам меняем через `{{ asset('...') }}`, например:
    
    `<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>`
    

---

## 🔹 Организация структуры

1. Создаём layout:
    
    - `resources/views/layouts/admin.blade.php`  
        (сюда копируем основной код AdminLTE).
        
2. Создаём отдельные partials (шаблоны):
    
    - `resources/views/includes/admin/sidebar.blade.php` — боковое меню.
        
    - Подключаем его через `@include`.
        

---

## 🔹 Работа с контентом

1. В layout прописываем `@yield('content')`.
    
2. В страницах админки используем:
    
    `@extends('layouts.admin')  @section('content')     <h1>Dashboard</h1> @endsection`
    

---

## 🔹 Роуты для админки

В Laravel 9+:

`use App\Http\Controllers\Admin\Post\IndexController;  Route::prefix('admin')->group(function () {     Route::get('/posts', IndexController::class)->name('admin.post.index'); });`

---

## 🔹 Создание CRUD для постов

1. Контроллеры: `app/Http/Controllers/Admin/Post/...`
    
    - `IndexController` (список постов)
        
    - `CreateController` (форма добавления)
        
    - `StoreController` (сохранение)
        
    - `EditController`, `UpdateController`, `DestroyController`
        
2. Views:
    
    - `resources/views/admin/posts/index.blade.php`
        
    - `create.blade.php`, `edit.blade.php` и т. д.
        
3. В sidebar выводим количество постов:
    
    `<span class="badge badge-info right">{{ \App\Models\Post::count() }}</span>`
    

---

## 🔹 Замечания

- Подключать плагины (`plugins/...`) только те, что реально нужны (иначе будут ошибки).
    
- AdminLTE можно легко кастомизировать: убирать ненужные блоки, менять цвета, добавлять свои элементы.
    
- Структуру лучше строить так:  
    `layouts/` → общие шаблоны  
    `includes/` → sidebar, navbar и т. д.  
    `admin/` → страницы админки
    

---

✨ В итоге: AdminLTE — это готовый фронтенд-шаблон, в Laravel он интегрируется через `layouts`, `asset()` и правильную организацию views.