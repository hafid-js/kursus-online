<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'instructor_id' => $this->instructor_id,
            'category_id' => $this->category_id,
            'course_type' => $this->course_type,
            'title' => $this->title,
            'slug' => $this->slug,
            'seo_description' => $this->seo_description,
            'duration' => $this->duration,
            'time_zone' => $this->time_zone,
            'thumbnail' => $this->thumbnail,
            'demo_video_storage' => $this->demo_video_storage,
            'demo_video_source' => $this->demo_video_source,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'discount' => $this->discount,
            'certificate' => (bool) $this->certificate,
            'qna' => (bool) $this->qna,
            'message_for_reviewer' => $this->message_for_reviewer,
            'is_approved' => $this->is_approved,
            'status' => $this->status,
            'course_level_id' => $this->course_level_id,
            'course_language_id' => $this->course_language_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),

            // Jika ingin tampilkan relasi (jika sudah eager loaded):
            'instructor' => $this->whenLoaded('instructor', fn () => new UserResource($this->instructor)),
            'category' => $this->whenLoaded('category', fn () => new CourseCategoryResource($this->category)),
            'level' => $this->whenLoaded('level', fn () => $this->level->name ?? null),
            'language' => $this->whenLoaded('language', fn () => $this->language->name ?? null),
        ];
    }
}
