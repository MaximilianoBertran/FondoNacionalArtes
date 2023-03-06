<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->name,
            'content' => $this->email,
            'created_at' => $this->created_at,
            'username' => $this->user->username,
            'photos' => $this->photos,
            'comments' => $this->comments,
        ];
    }
}
