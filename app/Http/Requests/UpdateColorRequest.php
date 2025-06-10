<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'color_id' => 'required|exists:colors,id',
            'name' => 'required|string|max:20',
            'hex' => 'required|string',
        ];
    }
}
