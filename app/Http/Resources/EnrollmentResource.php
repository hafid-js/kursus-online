<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            'course_id'    => $this->course_id,
            'instructor_id'=> $this->instructor_id,
            'have_access'  => (bool) $this->have_access,
            'created_at'   => $this->created_at?->toDateTimeString(),
            'updated_at'   => $this->updated_at?->toDateTimeString(),

            'user'       => UserResource::whenLoaded($this->user),
            'course'     => CourseResource::whenLoaded($this->course),
            'instructor' => UserResource::whenLoaded($this->instructor),
        ];
    }
}
