<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(["index", "detail"]);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view("articles.index", [
            'articles' => $data
        ]);
    }
    public function detail($id)
    {
        $data = Article::find($id);
        return view("articles.detail", [
            'article' => $data
        ]);
    }

    public function add()
    {
        return view("articles.add", [
            "categories" => Category::all()
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required|min:3|max:255",
            "body" => "required",
            "category_id" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->id();
        $article->save();

        return redirect("articles");
    }

    public function edit($id)
    {
        return view("articles.edit", [
            "article" => Article::findOrFail($id),
            "categories" => Category::all()
        ]);
    }

    public function update($id)
    {
        $article = Article::findOrFail($id);
        $validator = validator(request()->all(), [
            "title" => "required|min:3|max:255",
            "body" => "required",
            "category_id" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->update();

        return redirect("/articles/detail/$article->id")->with("updated", "Successfully Updated");
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if (Gate::allows("delete-article", $article)) {
            $article->delete();
            return redirect("/articles")->with("info", "Article Deleted");
        } else {
            return back()->with("info", "Unauthorize");
        }
    }
}
