<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'brand' => 'required|exists:brands,id',
            'model' => 'required|string|max:20',
            'color' => 'required|exists:colors,id',
            'type_id' => 'required|exists:types,id',
            'price' => 'required|numeric|min:0|max:120000',
            'horse_power' => 'required|numeric|min:0|max:1000',
            'sale' => 'nullable',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'secondary_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'year' => 'required|digits:4|integer|min:1900|max:2099',
            'description' => 'nullable|string|max:255',
        ];
    }
}
