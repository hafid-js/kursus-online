<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
            'image' => $this->image,
            'name' => $this->name,
            'headline' => $this->headline,
            'email' => $this->email,
            'bio' => $this->bio,
            'gender' => $this->gender,
            'document' => $this->document,
            'email_verified_at' => optional($this->email_verified_at)->toDateTimeString(),
            // do not expose in api
            'facebook' => $this->facebook,
            'x' => $this->x,
            'linkedin' => $this->linkedin,
            'website' => $this->website,
            'github' => $this->github,
            'approve_status' => $this->approve_status,
            'login_as' => $this->login_as,
            'wallet' => $this->wallet,
            'gauth_id' => $this->gauth_id,
            'gauth_type' => $this->gauth_type,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}

