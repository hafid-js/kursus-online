<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WatchHistoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'course' => new CourseResource($this->whenLoaded('course')),
            'chapter' => new CourseChapterResource($this->whenLoaded('chapter')),
            'lesson' => new CourseChapterLessionResource($this->whenLoaded('lesson')),
            'is_completed' => (bool) $this->is_completed,
            'watched_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
