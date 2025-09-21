## 1. Задача

- При создании поста мы должны выбрать категорию.
    
- При редактировании поста должна подставляться выбранная ранее категория.
    

---

## 2. Шаг 1. Вывод категорий в форму (create.blade.php)

`<div class="form-group">     <label for="category_id">Категория</label>     <select name="category_id" id="category_id" class="form-control">         @foreach($categories as $category)             <option value="{{ $category->id }}">                 {{ $category->title }}             </option>         @endforeach     </select> </div>`

📌 Обрати внимание:

- `name="category_id"` — обязательно, иначе данные не попадут в запрос.
    
- `value="{{ $category->id }}"` — в БД сохранится `id` категории.
    
- Отображается `{{ $category->title }}`.
    

---

## 3. Шаг 2. Прокидывание категорий в контроллер (PostController)

В методе `create`:

`public function create() {     $categories = Category::all();     return view('posts.create', compact('categories')); }`

В методе `store`:

`public function store(Request $request) {     $data = $request->validate([         'title' => 'required|string',         'content' => 'required|string',         'category_id' => 'required|exists:categories,id',     ]);      Post::create($data);      return redirect()->route('posts.index'); }`

---

## 4. Шаг 3. Форма для редактирования (edit.blade.php)

`<div class="form-group">     <label for="category_id">Категория</label>     <select name="category_id" id="category_id" class="form-control">         @foreach($categories as $category)             <option value="{{ $category->id }}"                 {{ $category->id == $post->category_id ? 'selected' : '' }}>                 {{ $category->title }}             </option>         @endforeach     </select> </div>`

📌 Здесь используется **тернарный оператор**:

`{{ $category->id == $post->category_id ? 'selected' : '' }}`

Это выделяет текущую категорию как выбранную.

---

## 5. Шаг 4. Контроллер для edit и update

`public function edit(Post $post) {     $categories = Category::all();     return view('posts.edit', compact('post', 'categories')); }  public function update(Request $request, Post $post) {     $data = $request->validate([         'title' => 'required|string',         'content' => 'required|string',         'category_id' => 'required|exists:categories,id',     ]);      $post->update($data);      return redirect()->route('posts.show', $post); }`

---

## 6. Проверка работы

1. При создании поста → в select выводятся все категории.
    
2. При редактировании → подставляется выбранная категория.
    
3. В базе у поста обновляется `category_id`.
    

---

✅ Итого:

- В `create` и `edit` мы добавили `<select>` с категориями.
    
- В контроллере передали `categories`.
    
- Валидация защищает от передачи несуществующего ID.
    
- `selected` помогает подставить текущую категорию в форму редактирования.