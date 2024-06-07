<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'birthday' => 'nullable|date|before:now',
            'details' => 'nullable|string|max:1000',
            'photo' => 'nullable|image',
        ];
    }
}
