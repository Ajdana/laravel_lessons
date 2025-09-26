## 🔹 Подготовка

- В Laravel по умолчанию есть:
    
    - миграция таблицы **users**
        
    - модель **User**
        
    - фабрика для пользователей
        

Это намекает, что система аутентификации встроена.

---

## 🔹 Установка UI

```Shell
php artisan ui:auth
```

или

```bash
php artisan ui vue --auth
```

или

```bash
php artisan ui bootstrap --auth
```

👉 создаются готовые шаблоны для **login** и **register**.

---

## 🔹 Что появляется

- В `resources/views` создаётся папка `auth/`
    
    - `login.blade.php`
        
    - `register.blade.php`
        
- В `routes/web.php` → новые маршруты `/login`, `/register`
    
- В `app/Http/Controllers/Auth` появляются контроллеры:
    
    - `LoginController`
        
    - `RegisterController`
        
    - `ForgotPasswordController`
        
    - `ResetPasswordController`
        

---

## 🔹 Регистрация

- Форма отправляет данные методом **POST** на `route('register')`.
    
- Обязательные поля:
    
    - `name`
        
    - `email`
        
    - `password`
        
    - `password_confirmation`
        
- Проверка данных идёт в `RegisterController` → метод `validator()`.
    
- Пользователь создаётся через:
    
    ```php
    User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);
    ```
    

---

## 🔹 Вход (Login)

- Форма отправляется методом **POST** на `route('login')`.
    
- Поля:
    
    - `email`
        
    - `password`
        
- Проверка данных идёт в `LoginController`.
    
- После успешного входа → редирект на `home`.
    

---

## 🔹 CSRF защита

Все формы должны содержать `@csrf`:

```blade
<form method="POST" action="{{ route('login') }}">
    @csrf
</form>
```

---

## 🔹 Кастомизация

- Можно создавать свои формы (любого дизайна).
    
- Главное:
    
    - `method="POST"`
        
    - правильный `action` (`/login` или `/register`)
        
    - правильные `name` для input’ов (`name`, `email`, `password`, `password_confirmation`).
        

---

## 🔹 Таблица Users

После регистрации в базе `users` появляются новые записи с зашифрованным паролем (`bcrypt`).

---

## ✨ Итог

1. Laravel уже имеет готовую систему аутентификации.
    
2. Достаточно выполнить `php artisan ui --auth`.
    
3. Система даёт маршруты `/login`, `/register`, `/logout`.
    
4. Обязательные поля строго заданы (см. `RegisterController`, `LoginController`).
    
5. Формы можно кастомизировать — главное не менять имена полей и маршруты.
    
