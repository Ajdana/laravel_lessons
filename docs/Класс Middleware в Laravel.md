### 1. Проблема

- После регистрации любой пользователь может зайти в админ-панель.
    
- Нужно ограничить доступ: только **admin** может видеть админские маршруты.
    

---

### 2. Добавление поля `role` в таблицу users

1. Создаём миграцию для добавления роли:
    
    `php artisan make:migration add_role_to_users_table --table=users`
    
2. В миграции:
    
    `public function up(): void {     Schema::table('users', function (Blueprint $table) {         $table->string('role')->default('user')->after('email');     }); }  public function down(): void {     Schema::table('users', function (Blueprint $table) {         $table->dropColumn('role');     }); }`
    
3. Запускаем:
    
    `php artisan migrate`
    

Теперь в таблице `users` есть поле `role`.  
По умолчанию `user`, можно вручную поменять в БД на `admin`.

---

### 3. Создание Middleware

`php artisan make:middleware AdminMiddleware`

В `app/Http/Middleware/AdminMiddleware.php`:

`namespace App\Http\Middleware;  use Closure; use Illuminate\Support\Facades\Auth;  class AdminMiddleware {     public function handle($request, Closure $next)     {         if (Auth::check() && Auth::user()->role === 'admin') {             return $next($request);         }          return redirect()->route('home'); // если не админ → на главную     } }`

---

### 4. Регистрация Middleware

В `app/Http/Kernel.php`, в массиве `$routeMiddleware`:

`'admin' => \App\Http\Middleware\AdminMiddleware::class,`

---

### 5. Применение Middleware к маршрутам

`Route::prefix('admin')     ->middleware(['auth', 'admin']) // защита маршрутов     ->group(function () {         Route::get('/post', \App\Http\Controllers\Admin\Post\IndexController::class)             ->name('admin.post.index');     });`

---

### 6. Итог

- Обычные пользователи (`role = user`) → будут редиректиться на `home`.
    
- Админы (`role = admin`) → имеют доступ к админке.
    
- Middleware выступает посредником: проверяет условия перед запуском контроллера.