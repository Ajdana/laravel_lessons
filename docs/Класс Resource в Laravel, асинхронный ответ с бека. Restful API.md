### Асинхронные запросы и JSON

- Когда фронтенд отправляет запрос (AJAX, fetch, axios и т. д.), **Laravel должен возвращать JSON**, а не HTML-страницу.
    
- Это позволяет фронтенду удобно работать с данными (подставлять title, content, image и др. без лишнего кода).
    

Пример простого ответа:

`return [     'title' => $post->title,     'content' => $post->content,     'image' => $post->image, ];`

---

### 🔹 Laravel API Resources

- **Resource** — это класс, который определяет, какие данные модели возвращать фронтенду.
    
- Генерация ресурса:
    

`php artisan make:resource PostResource`

- В `PostResource` указывается, какие поля вернуть:
    

`public function toArray($request) {     return [         'id'      => $this->id,         'title'   => $this->title,         'content' => $this->content,         'image'   => $this->image,     ]; }`

---

### 🔹 Возврат ресурса

- Для одного объекта:
    

`return new PostResource($post);`

- Для списка объектов (коллекция):
    

`return PostResource::collection(Post::all());`

- По умолчанию Laravel оборачивает всё в ключ `data` (это стандарт JSON:API):
    

`{   "data": [     { "id": 1, "title": "Hello", "content": "World" },     { "id": 2, "title": "Test", "content": "Post" }   ] }`

---

### 🔹 Пагинация

- Если использовать `paginate()`, Laravel автоматически добавит метаданные:
    

`return PostResource::collection(Post::paginate(10));`

Пример ответа:

`{   "data": [     { "id": 1, "title": "Post1" },     { "id": 2, "title": "Post2" }   ],   "links": {     "first": "http://127.0.0.1:8000/api/posts?page=1",     "last": "http://127.0.0.1:8000/api/posts?page=10",     "prev": null,     "next": "http://127.0.0.1:8000/api/posts?page=2"   },   "meta": {     "current_page": 1,     "from": 1,     "last_page": 10,     "per_page": 10,     "to": 10,     "total": 100   } }`

---

### 🔹 Обновление (Update)

- После изменения поста можно вернуть **обновлённый объект**:
    

`$post->update($request->all()); return new PostResource($post->fresh());`

---

### 🔹 Ошибки и CSRF

- При тестировании в Postman может выскакивать ошибка **419** (CSRF).
    
- Для API можно отключить CSRF в `App\Http\Middleware\VerifyCsrfToken`:
    

`protected $except = [     'api/*', ];`

---

### 🔹 Что такое REST API

- **REST API** (Representational State Transfer) — архитектура, где фронтенд и бэкенд общаются через HTTP-запросы и JSON-ответы.
    
- В Laravel REST API реализуется через:
    
    - маршруты (`routes/api.php`),
        
    - контроллеры,
        
    - ресурсы (`php artisan make:resource`),
        
    - JSON-ответы.
        

---

# ✍️ Итог

Теперь ты умеешь:

1. Возвращать JSON вместо HTML.
    
2. Работать с `Resource` и `Resource::collection`.
    
3. Подключать пагинацию.
    
4. Создавать полноценное REST API в Laravel.
    

👉 Если тебя на собеседовании спросят _«умеешь ли ты создавать REST API?»_, ты сможешь уверенно ответить:  
✅ Да, умею — с ресурсами, коллекциями, пагинацией и CRUD через JSON.