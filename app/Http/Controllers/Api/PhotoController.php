<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Photo;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    use ApiResponser;

    public function store($article_id, StorePhotoRequest $request)
    {
        $article = Article::findOrFail($article_id);
        $original_file_name = $request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->store('articles/'.$article->id, 'public');

        Photo::create([
            'original_name' => $original_file_name,
            'path' => $image_path,
            'article_id' => $article->id
        ]);
        $article->fresh();
        return $this->successResponse(['data' => new ArticleResource($article)]);
    }

    public function destroy($article_id, $photo_id){
        $article = Article::findOrFail($article_id);
        $photo = Photo::findOrFail($photo_id);

        if(Storage::disk('public')->exists($photo->path)){
            if(Storage::disk('public')->delete($photo->path)) {
                $photo->delete();
            }
        }else{
            return $this->errorResponse('File does not exist.', Response::HTTP_NOT_FOUND);
        }
        
        $article->fresh();
        return $this->successResponse(['data' => new ArticleResource($article)]);
    }
}
