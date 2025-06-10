<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\BrandController;

class Brand extends Model {

    protected $table = 'brands';
    protected $fillable = ['name'];

    public static function allBrands(): Collection {
        return self::all();
    }

    public static function createBrand(BrandController $request): bool {
        return (bool) self::create(['name' => $request->name]);
    }

    public static function findBrand(int $id): Brand|null {
        return self::find($id);
    }

    public static function editingBrand(BrandController $request): bool {
        return self::where('id', $request->id)->update(['name' => $request->name]);
    }

    public static function deleteBrand(BrandController $request): int {
        return self::where('id', $request->id)->delete();
    }
}
