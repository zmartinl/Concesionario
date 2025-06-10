<?php

namespace App\Models;

use App\Http\Controllers\CarController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarImage extends Model {

    protected $table = 'cars_images';
    protected $fillable = ['car_id', 'image'];

    public function car(): BelongsTo {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public static function updateImage(CarImage $carImage): bool {
        return self::where('id', $carImage->id)->update(['image' => $carImage->image]);
    }

    public static function storeImage(CarImage $carImage): CarImage {
        return self::create([
            'car_id' => $carImage->car_id,
            'image' => $carImage->image,
        ]);
    }

    public static function deleteSecondaryImages(CarController $request): void {
        if (is_array($request->secondaryImageDeleted)) {
            CarImage::whereIn('id', $request->secondaryImageDeleted)->delete();
        }
    }

    public static function getImagesByIds(CarController $request) {
        return self::whereIn('id', $request->secondaryImageDeleted)->get();
    }

    public static function getImageById(CarImage $carImage): ?CarImage {
        return self::where('id', $carImage->id)->first();
    }

    public static function getSecondaryImagesByCarId(CarController $request) {
        return self::where('car_id', $request->id)->get();
    }

    public static function imageExists(CarImage $carImage): bool {
        return self::where('id', $carImage->id)->exists();
    }

}
