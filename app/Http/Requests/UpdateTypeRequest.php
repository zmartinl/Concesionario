<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest {
    public function rules(): array {
        return [
            'type_id' => 'required|integer|exists:types,id',
            'type' => 'required|string|max:20',
        ];
    }
}
