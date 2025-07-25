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
            'title_one' => ['required','max:255','string'],
            'title_two' => ['required','max:255','string'],
            'title_three' => ['required','max:255','string'],
            'subtitle_one' => ['required','max:255','string'],
            'subtitle_two' => ['required','max:255','string'],
            'subtitle_three' => ['required','max:255','string'],
        ];
    }
}
