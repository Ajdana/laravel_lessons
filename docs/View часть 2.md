## 🔹 1. Проблема дублирования кода

- У разных страниц (Post, Main, About, Contact и др.) есть одинаковые части (шапка, футер).
    
- Чтобы не копировать код на каждую страницу, используется **система шаблонов Blade**.
    

---

## 🔹 2. Layout (основной шаблон)

- В `resources/views/layouts/` создаём файл, например:
    
    `main.blade.php`
    
- В нём размещаем повторяющиеся части сайта (header, footer).
    
- Для изменяемой части используем:
    
    `@yield('content')`
    

---

## 🔹 3. Подключение шаблонов (extends + section)

- Каждая страница расширяет (`extends`) основной шаблон:
    
    `@extends('layouts.main')  @section('content')     <h1>Post Page</h1> @endsection`
    
- Всё, что внутри `@section('content') ... @endsection`, будет подставляться в `@yield('content')` главного шаблона.
    

---

## 🔹 4. Контроллеры

- Для каждой страницы можно создать контроллер.  
    Пример `MainController`:
    
    `class MainController extends Controller {     public function index() {         return view('main');     } }`
    
- Аналогично для `PostController`, `AboutController`, `ContactController`.
    

---

## 🔹 5. Маршруты (routes/web.php)

- Настраиваем маршруты:
    
    `Route::get('/main', [MainController::class, 'index'])->name('main.index'); Route::get('/post', [PostController::class, 'index'])->name('post.index'); Route::get('/about', [AboutController::class, 'index'])->name('about.index'); Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');`
    
- `->name('...')` задаёт имя маршрута.
    

---

## 🔹 6. Навигация с использованием именованных маршрутов

В `main.blade.php` можно сделать меню:

`<nav>     <a href="{{ route('main.index') }}">Main</a>     <a href="{{ route('post.index') }}">Posts</a>     <a href="{{ route('about.index') }}">About</a>     <a href="{{ route('contact.index') }}">Contact</a> </nav>`

---

## 🔹 7. Результат

- Есть **layout** с общей структурой.
    
- Есть **несколько страниц**, которые вставляют свой контент в layout.
    
- Навигация работает через **именованные маршруты**, поэтому ссылки всегда корректны.
    

---

✅ Итого:  
Мы реализовали полный цикл:

- `Route` → вызывает `Controller`
    
- `Controller` → отдаёт данные во `View`
    
- `View` → подставляется в общий `Layout`