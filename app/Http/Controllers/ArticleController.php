<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeArticleRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);
        return view("articles.index", ['articles' => $data]);
    }

    public function detail($id)
    {
        $data = Article::find($id);


        return view("articles.detail", [
            'article' => $data
        ]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if (Gate::allows('delete-article', $article)) {

            $article->delete();

            return redirect("/articles")->with("info", "Action Deleted");
        }

        return back()->with('info', 'Unauthorize');
    }

    public function add()
    {
        $categories = Category::All();
        return view("articles.add", compact('categories'));
    }

    public function create(storeArticleRequest $request)
    {

        // $validator = validator(request()->all(), [
        //     "title" => "required",
        //     "body" => "required",
        //     "category_id" => "required",
        // ]);


        // if ($validator->fails()) {
        //     return back()->withErrors($validator);
        // }


        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->id();
        $article->save();

        return redirect("/articles");
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $validator = validator($request->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->category_id = $request->input('category_id');
        $article->save();


        return redirect("/articles")->with("update", "Article Updated");
    }
}
