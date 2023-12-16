

@extends("layouts.app")


@section("content")
    <div class="container" style="max-width: 800px">
            <div class="card mb-2 border-primary">
                <div class="card-body" style="font-size: 1.2em">
                    <h3 class="card-title">{{ $article->title }}</h3>
                    <div class="text-muted">{{ $article->created_at->diffForHumans() }}</div>
                    <div class="">{{ $article->body}}</div>
                    <a href="{{ url("/articles/delete/$article->id")}}" class="btn btn-sm btn-danger">Delete</a>
                </div>
            </div>

    </div>
@endsection
