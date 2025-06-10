<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ColorController;

class Color extends Model {

    protected $table = 'colors';
    protected $fillable = ['name', 'hex'];

    public static function allColors():Collection{
        return self::all();
    }

    public static function addColor(ColorController $request): bool{
        return (bool) self::create([
            'name' => $request->name,
            'hex' => $request->hex
        ]);

    }

    public static function findColor(int $id): Color | null {
        return self::find($id);
    }

    public static function editingColor(ColorController $request): Bool {

        return self::where('id', $request->id)->update([
            'name' => $request->name,
            'hex' => $request->hex
        ]);
        
    }

    public static function deleteColor(ColorController $request): Bool {
        return self::where('id', $request->id)->delete();
    }
}
