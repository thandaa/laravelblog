@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 800px">

        @if(session('info'))
        <div class="alert alert-info">
            {{session('info')}}
        </div>
        @endif

        <div class="card mb-2 border-primary">
            <div class="card-body" style="font-size: 1.2em">
                <h3 class="card-title">{{ $article->title }}</h3>
                <div class="text-muted">
                    <b class="text-success">{{$article->user->name}}</b>,
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <div class="mb-2">
                    {{ $article->body }}
                </div>
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-sm btn-danger">Delete</a>
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-sm btn-primary">Edit</a>
            </div>
        </div>

        <ul class="list-group mt-4">
            <li class="list-group-item active">
                Comments ({{ count($article->comments) }})
            </li>

            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>

                    <b class="text-success">{{$comment->user->name}}</b> -
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>

        <form action="{{url("/comments/add")}}" method="post">
        @csrf
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <textarea name="content" class="form-control my-2"></textarea>
        <button class="btn btn-secondary">Add Comment</button>
        </form>


    </div>
@endsection
