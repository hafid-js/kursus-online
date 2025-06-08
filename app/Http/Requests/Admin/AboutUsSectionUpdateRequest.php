<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsSectionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable','image','max:3000'],
            'rounded_text' => ['nullable','string','max:255'],
            'learner_count' => ['nullable','string','max:255'],
            'learner_count_text' => ['nullable','string','max:255'],
            'learner_image' => ['nullable','image','max:3000'],
            'title' => ['nullable','string','max:255'],
            'description' => ['nullable','string','max:1000'],
            'button_text' => ['nullable','string','max:255'],
            'button_url' => ['nullable','string','max:255'],
            'video_image' => ['nullable','image','max:3000'],
            'video_url' => ['nullable','string','max:255'],

        ];
    }
}
