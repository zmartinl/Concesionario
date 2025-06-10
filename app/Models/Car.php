<?php

namespace App\Models;

use App\Http\Controllers\CarController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
class Car extends Model {
    
    protected $table = 'cars';
    protected $fillable = ['name', 'brand_id', 'type_id', 'color_id', 'price', 'horse_power', 'sale', 'year', 'description', 'main_image'];

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    
    public function color(): BelongsTo {
        return $this->belongsTo(Color::class, 'color_id');
    }
    
    public function images(): HasMany {
        return $this->hasMany(CarImage::class, 'car_id');
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class, 'type_id');
    }
    
    
    public static function allCars(): Collection {
        return self::query()->with(['brand', 'color', 'type'])->get();
    }
    
    

    public static function listCarsAdmin(): Collection{

        return self::join('brands', 'cars.brand_id', '=', 'brands.id')
            ->join('types', 'cars.type_id', '=', 'types.id')
            ->join('colors', 'cars.color_id', '=', 'colors.id')
            ->leftJoin('cars_images', 'cars.id', '=', 'cars_images.car_id')
            ->select(
                'cars.*',
                'brands.name as brand_name',
                'types.name as type_name',
                'colors.name as color_name',
                'colors.hex as color_hex',
                DB::raw('GROUP_CONCAT(cars_images.image SEPARATOR ", ") as secondary_images')
            )
            ->groupBy('cars.id')
            ->get();

    }

    public static function getTech(CarController $request): Collection {

        return self::join('brands', 'cars.brand_id', '=', 'brands.id')
            ->join('types', 'cars.type_id', '=', 'types.id')
            ->join('colors', 'cars.color_id', '=', 'colors.id')
            ->leftJoin('cars_images', 'cars.id', '=', 'cars_images.car_id')
            ->select(
                'cars.*', 
                'brands.name as brand_name', 
                'types.name as type_name', 
                'colors.name as color_name', 
                'colors.hex as color_hex',
                DB::raw("GROUP_CONCAT(cars_images.image SEPARATOR ';') as images")
            )
            ->where('cars.id', $request->id)
            ->groupBy('cars.id', 'brands.name', 'types.name', 'colors.name', 'colors.hex') 
            ->get();

    }

    public static function deleteCar(CarController $request): bool{
        return self::where('id', $request->id)->delete();
    }

    public static function getCarById(int $id)
    {
        return self::find($id);
    }

    public static function createCar(CarController $request): Car
    {

        return self::create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'color_id' => $request->color_id,
            'type_id' => $request->type_id, 
            'price' => $request->price,
            'horse_power' => $request->horse_power,
            'sale' => $request->sale,
            'main_image' => $request->main_image,
            'year' => $request->year, 
            'description' => $request->description, 
        ]);

    }

    public static function updateCar(CarController $request): bool
    {

        $car = self::find($request->id);  

        if (!$car) {
           
            return false;

        }

        return $car->update([  
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'color_id' => $request->color_id,
            'type_id' => $request->type_id,
            'price' => $request->price,
            'horse_power' => $request->horse_power,
            'sale' => $request->sale,
            'main_image' => $request->main_image ?? $car->main_image,  
            'year' => $request->year,
            'description' => $request->description,
        ]);
        
    }

    public static function findWithImages($id)
    {
        return self::with('images')->find($id);
    }

}
