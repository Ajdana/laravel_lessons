### 1. Зачем нужны Policy

- Policy — специальные классы для проверки прав пользователей.
    
- Используются, чтобы **разрешать или запрещать действия** (просмотр, создание, редактирование, удаление и т.д.).
    
- Работают как альтернатива или дополнение к `middleware`.
    

---

### 2. Создание Policy

`php artisan make:policy AdminPolicy`

- По умолчанию класс создаётся в `app/Policies`.
    
- Чтобы сразу привязать к модели (например, `User`):
    

`php artisan make:policy AdminPolicy -m User`

---

### 3. Методы Policy

Примеры методов:

- `view` – проверка, может ли пользователь просматривать.
    
- `create` – проверка на создание.
    
- `update` – проверка на обновление.
    
- `delete` – удаление.
    
- `restore` – восстановление.
    
- `forceDelete` – полное удаление (в обход soft delete).
    

---

### 4. Регистрация Policy

В `AuthServiceProvider`:

`protected $policies = [     User::class => \App\Policies\AdminPolicy::class, ];`

---

### 5. Использование Policy

#### В контроллере:

`public function index() {     $this->authorize('view', auth()->user());     return view('admin.index'); }`

#### В Blade-шаблоне:

`@can('view', auth()->user())     <a href="{{ route('admin.post.index') }}">Админ-панель</a> @endcan`

Если проверка не пройдена — ссылка не отобразится.

---

### 6. Пример условия внутри Policy

`public function view(User $user) {     return $user->role === 'admin'; }`

Только пользователи с ролью `admin` смогут видеть админку.

---

✅ **Итог:**  
Policy — это удобный инструмент для проверки прав доступа. Создаём с `make:policy`, регистрируем в `AuthServiceProvider`, прописываем логику проверки (например, по роли), а потом используем через `authorize()` в контроллере или `@can` в шаблонах.