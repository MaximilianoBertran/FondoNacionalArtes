<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\User;

class ArticleController extends Controller
{
    use ApiResponser;

    public function index($user_id = null) {
        
        $articles = Article::orderBy('id', 'DESC')->get();

        if($user_id) {
            $user = User::findOrFail($user_id);
            $articles = $articles->where('user_id', $user->id);
        }

        return $this->successResponse(['data' => ArticleResource::collection($articles)], Response::HTTP_CREATED);
    }

    public function store(StoreArticleRequest $request) {
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = auth()->user()->id;
        $article->save();

        return $this->successResponse(['data' => $article], Response::HTTP_CREATED);
    }

    public function destroy($article_id)
    {
        $article = Article::findOrFail($article_id);
        $article->delete();

        return $this->successResponse(['message' => 'The article is deleted']);
    }
}
