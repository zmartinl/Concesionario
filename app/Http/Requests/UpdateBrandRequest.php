<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest {

    public function rules(): array {
        return [
            'brand' => 'required|string|max:20',
            'brand_id' => 'required|integer|exists:brands,id',
        ];
    }
}
