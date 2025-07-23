<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogCommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
