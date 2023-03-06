<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    use ApiResponser;
    
    public function store($article_id, StoreCommentRequest $request) {
        $article = Article::findOrFail($article_id);
        $comment = new Comment();
        $comment->data = $request->data;
        $comment->article_id = $article->id;
        $comment->save();

        return $this->successResponse(['data' => $comment], Response::HTTP_CREATED);
    }

    public function destroy($article_id, $comment_id)
    {
        $article = Article::findOrFail($article_id);
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();

        return $this->successResponse(['message' => 'The comment is deleted']);
    }
}
