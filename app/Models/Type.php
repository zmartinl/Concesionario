<?php

namespace App\Models;

use App\Http\Controllers\TypeController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Type extends Model {
    protected $table = 'types';
    protected $fillable = ['name'];

    public static function allTypes(): Collection{
        return self::all();
    }
    public static function addType(TypeController $request): bool{

        return (bool) self::create([
            'name' => $request->name
        ]);

    }

    public static function findType(int $id): Type | null{
        return self::find($id);
    }

    public static function editingType(TypeController $request): bool {
        return self::where('id', $request->id)->update(['name' => $request->name]);
    }
    

    public static function deleteType(TypeController $request): bool {
       return self::where('id', $request->id)->delete();
    }
}