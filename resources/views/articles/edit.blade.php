@extends("layouts.app")

@section("content")

<div class="container" style="max-width: 800px">

    @if($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
    @endif
    
    <form action="{{ url('/articles/edit/' . $article->id) }}" method="post">
        @csrf

        <div class="mb-2">
            <label for="">Title</label>
            <input type="text" name="title" class="form-control" value="{{$article->title}}">
        </div>
        <div class="mb-2">
            <label for="">Body</label>
            <textarea name="body" class="form-control">{{$article->body}}</textarea>
        </div>
        <div class="mb-2">
            <label for="">Category</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Update Article</button>
    </form>
</div>
@endsection