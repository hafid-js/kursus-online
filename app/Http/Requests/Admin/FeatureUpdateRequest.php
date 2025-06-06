<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeatureUpdateRequest extends FormRequest
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
            'image_one' => ['nullable','image','max:3000'],
            'image_two' => ['nullable','image','max:3000'],
            'image_three' => ['nullable','image','max:3000'],
            'title_one' => ['nullable','max:255','string'],
            'title_two' => ['nullable','max:255','string'],
            'title_three' => ['nullable','max:255','string'],
            'subtitle_one' => ['nullable','max:255','string'],
            'subtitle_two' => ['nullable','max:255','string'],
            'subtitle_three' => ['nullable','max:255','string'],
        ];
    }
}
