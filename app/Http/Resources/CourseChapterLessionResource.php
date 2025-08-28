<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseChapterLessionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'instructor' => new UserResource($this->whenLoaded('instructor')),
            'course_id' => $this->course_id,
            'chapter' => new CourseChapterResource($this->whenLoaded('chapter')),
            'file_path' => $this->file_path,
            'storage' => $this->storage,
            'volume' => $this->volume,
            'duration' => $this->duration,
            'file_type' => $this->file_type,
            'downloadable' => (bool) $this->downloadable,
            'order' => $this->order,
            'is_preview' => (bool) $this->is_preview,
            'status' => (bool) $this->status,
            'lesson_type' => $this->lesson_type,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
