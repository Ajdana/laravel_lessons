## 1. Проблема

- У поста может быть несколько тегов.
    
- Это **связь многие-ко-многим (many-to-many)** между таблицами `posts` и `tags`.
    
- Для этого создаётся **связующая таблица (pivot-table)**, например `post_tag`.
    

---

## 2. Миграции

### Таблица `posts`

`Schema::create('posts', function (Blueprint $table) {     $table->id();     $table->string('title');     $table->text('content');     $table->timestamps(); });`

### Таблица `tags`

`Schema::create('tags', function (Blueprint $table) {     $table->id();     $table->string('name');     $table->timestamps(); });`

### Таблица `post_tag` (pivot)

`Schema::create('post_tag', function (Blueprint $table) {     $table->id();     $table->foreignId('post_id')->constrained()->onDelete('cascade');     $table->foreignId('tag_id')->constrained()->onDelete('cascade');     $table->timestamps(); // можно убрать, если не нужны });`

---

## 3. Модели

### `Post.php`

`class Post extends Model {     protected $guarded = false; // разрешаем массовое заполнение      public function tags()     {         return $this->belongsToMany(Tag::class);     } }`

### `Tag.php`

`class Tag extends Model {     protected $guarded = false;      public function posts()     {         return $this->belongsToMany(Post::class);     } }`

---

## 4. Форма (Blade)

Пример с **multiple select**:

`<form action="{{ route('posts.store') }}" method="POST">     @csrf     <input type="text" name="title" placeholder="Заголовок">     <textarea name="content" placeholder="Контент"></textarea>      <select name="tags[]" multiple>         @foreach($tags as $tag)             <option value="{{ $tag->id }}">{{ $tag->name }}</option>         @endforeach     </select>      <button type="submit">Создать</button> </form>`

> ⚡ Важно: у поля должно быть `tags[]`, чтобы данные приходили в виде массива.

---

## 5. Контроллер

### `PostController@store`

`public function store(Request $request) {     $data = $request->all();      // вытаскиваем теги отдельно     $tags = $data['tags'];     unset($data['tags']);      // создаём пост     $post = Post::create($data);      // привязываем теги (many-to-many)     $post->tags()->attach($tags);      return redirect()->route('posts.index'); }`

---

## 6. Работа с pivot-таблицей

### `attach()`

Просто привязка тегов:

`$post->tags()->attach([1, 2, 3]);`

### `sync()`

Удалит старые и привяжет новые:

`$post->tags()->sync([2, 3]);`

### `detach()`

Удалит привязку:

`$post->tags()->detach([1]);`

---

## 7. Ошибки и нюансы

- Если не поставить `[]` в `name="tags[]"`, то придёт только один тег.
    
- Если использовать `create()` вместо `attach`, можно получить дубли в pivot-таблице.
    
- Чтобы избежать дублей — использовать `sync()`.
    
- Важно использовать **транзакции** (`DB::transaction()`), если создаётся несколько связанных записей (иначе при ошибке можно получить «битые» данные).
    

---

## 8. Итоговый сценарий

1. Создали таблицы `posts`, `tags`, `post_tag`.
    
2. Настроили связь `belongsToMany` в моделях.
    
3. В форме сделали `multiple select`.
    
4. В контроллере:
    
    - сохранили пост,
        
    - прикрепили выбранные теги через `attach()` или `sync()`.
        

---

👉 В итоге: когда создаёшь новый пост, к нему сразу привязываются выбранные теги, и в таблице `post_tag` автоматически появляются записи вида:

| id  | post_id | tag_id |
| --- | ------- | ------ |
| 1   | 7       | 1      |
| 2   | 7       | 2      |
| 3   | 7       | 3      |