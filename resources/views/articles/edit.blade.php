@extends("layouts.app")


@section("content")
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                            {{$error}} <br />
                            @endforeach
                        </div>
                        @endif

                        <form action="/articles/edit/{{$article->id}}" method="POST">
                            @csrf
                            @method("PUT")

                            <div class="mb-4">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{$article->title}}" id="title"
                                    class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" class="form-control">{{$article->body}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="category">Title</label>
                                <select name="category_id" id="category" class="form-select">
                                    @foreach ($categories as $category)
                                    <option @selected($article->category_id == $category->id)
                                        value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <a href="{{url('/articles/detail/'.$article->id)}}" class="btn btn-secondary">Back</a>

                            <button class="btn btn-primary float-end">Update Article</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection