<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest {
    public function rules(): array {
        return [
            'type' => 'required|string|max:20',
        ];
    }
}
