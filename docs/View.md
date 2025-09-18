### 1. Что такое View

- **View** (представление) — это шаблон, который возвращается пользователю.
    
- В Laravel используются **Blade-шаблоны** (`.blade.php`).
    
- Располагаются в папке `resources/views/`.
    

---

### 🔹 2. Создание View

1. В папке `resources/views` создаём файл:
    
    `post.blade.php`
    
2. В маршруте (`routes/web.php`) указываем:
    
    `Route::get('/post', function () {     return view('post'); });`
    
    👉 `view('post')` ищет файл `resources/views/post.blade.php`.
    

---

### 🔹 3. Blade-шаблоны

- Это HTML + упрощённый PHP.
    
- Поддерживает специальные **директивы**:
    
    - `@foreach` … `@endforeach`
        
    - `@if` … `@endif`
        
    - `{{ $variable }}` — вывод переменной.
        

---

### 🔹 4. Передача данных во View

- Можно передать переменные вторым аргументом функции `view`:
    
    `Route::get('/post', function () {     $posts = [         ['title' => 'Первый пост'],         ['title' => 'Второй пост']     ];     return view('post', compact('posts')); });`
    
- Теперь в `post.blade.php` доступна переменная `$posts`.
    

---

### 🔹 5. Вывод данных во View

Пример (`post.blade.php`):

`<!DOCTYPE html> <html> <head>     <title>Список постов</title> </head> <body>     <h1>Посты:</h1>     @foreach($posts as $post)         <p>{{ $post['title'] }}</p>     @endforeach </body> </html>`

---

### 🔹 6. Ошибки

- Если переменная не передана в `view()`, Blade выдаст ошибку `Undefined variable`.
    
- Нужно обязательно передавать переменные через `compact` или массив.
    

---

✅ Итого:

- View в Laravel — это HTML-шаблон с Blade-синтаксисом.
    
- Данные передаются через `view('имя', compact('переменная'))`.
    
- В шаблоне доступны Blade-директивы для удобства работы.