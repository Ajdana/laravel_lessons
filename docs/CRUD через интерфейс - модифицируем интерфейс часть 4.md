У нас есть интерфейс по созданию постов , редактированию . Но у нас есть одна пробелам если мы хотим отправить запрос , но мы не написали ничего в ячейках чтобы обновилось или создалось . Он возвращает нас на эту же страницу . 

1 Добавляем error (для того чтобы в пустых ячейках конкретно указывалось что было не прописано)
2 value="{{old('image')}} указываем value с значением old чтобы показывались то что мы указали .
3 required| указываем в Controllere чтобы указывалось точно какой тип данных мы не написали 
```php
<div class="form-group">  
    <label for="title">Title</label>  
    <input  
        value="{{old('title')}}"  
        type="text" name="title" class="form-control" id="title" placeholder="Title">  
    @error('title')  
    <p class="text-danger">{{$message}}</p>  
    @enderror  
</div>  
<div class="form-group">  
    <label for="content">Content</label>  
    <textarea class="form-control" name="content" id="content" placeholder="Content">{{old('content')}}</textarea>  
    @error('content')  
    <p class="text-danger">{{$message}}</p>  
    @enderror  
</div>  
<div class="form-group">  
    <label for="image">Image</label>  
    <input value="{{old('image')}}" type="text" name="image" class="form-control" id="image" placeholder="Image">  
    @error('image')  
    <p class="text-danger">{{$message}}</p>  
    @enderror  
</div>  
<div class="form-group">  
    <label for="category">Category</label>  
    <select class="form-control" id="category" name="category_id">  
        @foreach($categories as $category)  
            <option  
                {{old('category_id') == $category->id ? 'selected' : ''}}  
  
                value="{{$category->id}}">{{$category->title}}</option>  
        @endforeach  
    </select>  
</div>  
<div class="form-group">  
    <label for="tags">Tags</label>  
    <select multiple class="form-control" id="tags" name="tags[]">  
        @foreach($tags as $tag)  
            <option value="{{$tag->id}}">{{$tag->title}}</option>  
        @endforeach  
    </select>  
</div>
```

Validate - проверка информаций на корректность . Когда мы получаем то что хотим получить . 