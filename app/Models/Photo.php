<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'original_name', 'article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
