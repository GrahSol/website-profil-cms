<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'keypoints' => ['nullable', 'array'],           // Jadikan nullable
            'keypoints.*' => ['nullable', 'string', 'max:255'], // Jadikan nullable
        ];
    }
}