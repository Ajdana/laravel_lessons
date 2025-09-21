@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('post.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" id="content" placeholder="Content"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" name="image" class="form-control" id="image" placeholder="Image">
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="category">Category</label>--}}
{{--                <select class="form-control" id="category" name="category_id">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <select class="form-select" multiple aria-label="multiple select example">--}}
{{--                <option selected>Tags</option>--}}
{{--                <option value="1">One</option>--}}
{{--                <option value="2">Two</option>--}}
{{--                <option value="3">Three</option>--}}
{{--            </select>--}}
            <br>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
