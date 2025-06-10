<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest {
    public function rules(): array {

        return [
            'brand' => 'required|string|max:20',
        ];
        
    }
}
