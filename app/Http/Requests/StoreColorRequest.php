<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => 'required|string',
            'hex' => 'required|string',
        ];
    }
}
