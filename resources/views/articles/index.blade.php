@extends("layouts.app")


@section("content")
<div class="container" style="max-width: 800px">
    {{ $articles->links()}}

    @if (session("info"))
    <div class="alert alert-info">{{ session("info")}}</div>

    @endif


    @foreach ($articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <h3 class="card-title">{{ $article->title }}</h3>
            <div class="d-flex">
                <h4 class="h5 text-success me-2">Author : {{$article->user->name}}</h4>|
                <h4 class="h5 text-secondary mx-2">Comments : {{count($article->comments)}}</h4>|
                <h4 class="h5 text-warning mx-2">Category : <span class="badge bg-secondary">
                        {{ $article->category->name }}</span>
                </h4>
            </div>
            <div class=" text-muted">{{ $article->created_at->diffForHumans() }}
            </div>
            <div class="">{{ $article->body}}</div>
            <a href="{{ url("/articles/detail/$article->id")}}" class="card-link">View Detail</a>
        </div>
    </div>
    @endforeach

</div>
@endsection
