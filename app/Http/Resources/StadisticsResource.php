<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StadisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'articles' => $this->articles->count(),
            'articles_with_photos' => $this->articlesWithPhoto(),
            'articles_without_photos' => $this->articlesWithoutPhoto(),
            'comments' => $this->commentsByArticles(),
        ];
    }
}
