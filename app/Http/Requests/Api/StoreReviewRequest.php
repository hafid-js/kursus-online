<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize()
    {
        // Pastikan user sudah login via Passport (API auth)
        return $this->user() != null;
    }

    public function rules()
    {
        return [
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'review' => ['required', 'string', 'max:1000'],
            'course' => ['required', 'integer', 'exists:courses,id'],
        ];
    }
}
