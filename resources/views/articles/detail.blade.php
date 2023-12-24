@extends("layouts.app")


@section("content")
<div class="container" style="max-width: 800px">

    @if (session('info'))
    <div class="alert alert-info">
        {{session('info')}}
    </div>
    @endif

    <div class="card mb-2 border-primary">
        <div class="card-body" style="font-size: 1.2em">

            @if (session('updated'))
            <div class="alert alert-success">
                {{session("updated")}}
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="card-title">{{ $article->title }}</h3>
                @can('edit-article',$article)
                <a href="{{url("articles/edit/$article->id")}}" class="btn btn-sm btn-outline-warning">Edit</a>
                @endcan
            </div>

            <div class="card-title text-info">
                <span>Author : </span>
                {{ $article->user->name }}
            </div>

            <div class="card-title badge bg-secondary">{{ $article->category->name }}</div>

            <div class="text-muted">{{ $article->created_at->diffForHumans() }}</div>
            <div class="">{{ $article->body}}</div>
            @can('delete-article',$article)
            <a href="{{ url("/articles/delete/$article->id")}}" class="btn btn-sm btn-danger mt-3 float-end">Delete</a>
            @endcan
        </div>
    </div>

    <ul class="list-group mt-4">
        <li class="list-group-item bg-primary">Comments ({{count($article->comments)}})</li>
        @foreach ($article->comments as $comment)
        <li class="list-group-item">
            @can("delete-comment",$comment)
            <a href="{{url('/comments/delete/'.$comment->id)}}" class="btn-close float-end"></a>
            @endcan
            <span class="text-primary">{{$comment->user->name}}</span> - {{$comment->content}}
        </li>
        @endforeach
    </ul>

    @auth
    <form action="{{url('/comments/add')}}" method="POST">
        @csrf

        <input type="hidden" name="article_id" value="{{$article->id}}">
        <textarea name="content" id="content" class="form-control mt-3" placeholder="Enter Your Comment"></textarea>

        <button class="btn btn-primary mt-2 float-end">Add Comment</button>
    </form>
    @endauth
</div>
@endsection