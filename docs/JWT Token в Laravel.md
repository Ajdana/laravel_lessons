## Проблема

- Если использовать `web.php` для API-запросов и отключать CSRF-токены, появляется **серьёзная уязвимость**.
    
- `web.php` — для синхронного интерфейса (браузерные страницы).
    
- Для API запросов есть отдельный файл — **`api.php`**, где CSRF-проверки не нужны.
    

---

## 🔹 Решение: JWT-токен

- JWT (**JSON Web Token**) — способ авторизации для API.
    
- Схема работы:
    
    1. Пользователь отправляет логин и пароль на `/api/login`.
        
    2. В ответ получает **токен**.
        
    3. Все последующие запросы к API отправляются с этим токеном в заголовке `Authorization: Bearer <token>`.
        

---

## 🔹 Установка JWT пакета

1. Установить пакет:
    
    `composer require tymon/jwt-auth`
    
2. Опубликовать конфиг:
    
    `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`
    
3. Сгенерировать секретный ключ:
    
    `php artisan jwt:secret`
    
    🔑 В `config/jwt.php` появится ключ.
    

---

## 🔹 Настройка модели User

В `app/Models/User.php` подключаем интерфейс:

`use Tymon\JWTAuth\Contracts\JWTSubject;  class User extends Authenticatable implements JWTSubject {     public function getJWTIdentifier()     {         return $this->getKey();     }      public function getJWTCustomClaims()     {         return [];     } }`

---

## 🔹 Настройка guard

В `config/auth.php` → секция `guards`:

`'guards' => [     'api' => [         'driver' => 'jwt',         'provider' => 'users',     ], ],`

---

## 🔹 Роуты

В `routes/api.php`:

`Route::post('login', [AuthController::class, 'login']); Route::get('posts', [PostController::class, 'index'])->middleware('auth:api');`

---

## 🔹 Контроллер авторизации

Пример `AuthController`:

`class AuthController extends Controller {     public function login(Request $request)     {         $credentials = $request->only('email', 'password');          if (! $token = auth()->attempt($credentials)) {             return response()->json(['error' => 'Unauthorized'], 401);         }          return response()->json([             'access_token' => $token,             'token_type'   => 'bearer',             'expires_in'   => auth()->factory()->getTTL() * 60         ]);     } }`

---

## 🔹 Проверка через Postman

1. Запрос `POST /api/login` → передаем email и password.
    
2. Получаем токен.
    
3. Для запроса `GET /api/posts` добавляем заголовок:
    
    `Authorization: Bearer <token>`
    

---

## 🔹 Защита API

- Все приватные маршруты оборачиваются в `->middleware('auth:api')`.
    
- Без токена клиент получает ошибку:
    
    `{ "message": "Unauthenticated." }`
    

---

## ✍️ Итог

1. Для API используем **routes/api.php**, а не `web.php`.
    
2. CSRF не нужен — вместо этого используется **JWT-токен**.
    
3. Подключение:
    
    - Установка пакета `tymon/jwt-auth`.
        
    - Настройка `User` и `auth.php`.
        
    - Создание `login` маршрута.
        
4. Использование:
    
    - Получаем токен через `/api/login`.
        
    - Отправляем его в заголовке `Authorization: Bearer`.
        
    - Доступ к защищённым роутам возможен только с токеном.