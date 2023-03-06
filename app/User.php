<?php

namespace App;

use App\Models\Article;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function commentsByArticles() {
        $response= [];
        foreach ($this->articles as $article) {
            $response[] = [ 
                'id' => $article->id,
                'title' => $article->title,
                'comments' => $article->comments->count()
            ];
        }

        return $response;
    }

    public function articlesWithPhoto() {
        return count(Article::where('user_id', $this->id)->join('photos', 'articles.id', '=', 'photos.article_id')->select('articles.id')->distinct()->get());
    }

    public function articlesWithoutPhoto() {
        return Article::where('user_id', $this->id)->leftJoin('photos', 'articles.id', '=', 'photos.article_id')->where('photos.id', null)->count();
    }
}
