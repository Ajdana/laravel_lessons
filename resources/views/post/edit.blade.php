@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('post.update', $post->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                       value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" id="content"
                          placeholder="Content">{{$post->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" name="image" class="form-control" id="image" value="{{$post->image}}"
                       placeholder="Image">
            </div>

{{--            <div class="form-group">--}}
{{--                <label for="category">Category</label>--}}
{{--                <select class="form-control" id="category" name="category_id">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <option--}}
{{--                            {{$category->id === $post->category->id ? 'selected' : ''}}--}}

{{--                            value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
