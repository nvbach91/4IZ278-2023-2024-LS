<?php

namespace App\Http\Requests;

use App\Rules\AvailableTimeCollision;
use App\Rules\AvailableTimeMinLength;
use Illuminate\Foundation\Http\FormRequest;

class AvailableTimeUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start' => ['required', 'date', 'date_format:Y-m-d\TH:i', 'after:now', new AvailableTimeCollision],
            'end' => ['required', 'date', 'date_format:Y-m-d\TH:i', 'after:start', new AvailableTimeMinLength],
        ];
    }
}
