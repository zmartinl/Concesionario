<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Type;
use App\Models\CarImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Requests\StoreCarRequest;
use Illuminate\Support\Collection;


class CarController extends Controller
{
    public Car $carModel;
    public Brand $brandModel;
    public Color $colorModel;
    public Type $typeModel;
    public CarImage $carImageModel;

    //Properties 

    public ?int $id = NULL;
    public ?Brand $brand = NULL;
    public ?Type $type = NULL;
    public ?Color $color = NULL;
    public ?string $name = NULL;
    public ?int $year = NULL;
    public ?float $horse_power = NULL;
    public ?float $price = NULL;
    public ?string $main_image = NULL;
    public ?string $sale = NULL;

    public ?string $secondaryImage = NULL;

    public ?array $secondaryImageDeleted = NULL;

    public ?Collection $collection = NULL;

    public ?int $secondaryImageId = NULL;

    public ?string $description = NULL;

    public ?int $brand_id = NULL;

    public ?int $color_id = NULL;

    public ?int $type_id = NULL;

    public function __construct() {

    }

    public function getTech(int $id): View {

        $car = Car::getCarById($id);

        $this->id = $car->id;
        $this->brand_id = $car->brand_id;
        $this->name = $car->name;
        $this->color_id = $car->color_id;
        $this->type_id = $car->type_id;
        $this->price = $car->price;
        $this->horse_power = $car->horse_power;
        $this->sale = $car->sale;
        $this->year = $car->year;
        $this->description = $car->description;
        $this->main_image = $car->main_image;

        return view('tech_sheet.tech_sheet', [
            'cars' => Car::getTech($this),
        ]);

    }

    public function deleteCar(int $id): RedirectResponse {

        $car = Car::getCarById($id);

        $this->id = $car->id;
        $this->brand_id = $car->brand_id;
        $this->name = $car->name;
        $this->color_id = $car->color_id;
        $this->type_id = $car->type_id;
        $this->price = $car->price;
        $this->horse_power = $car->horse_power;
        $this->sale = $car->sale;
        $this->year = $car->year;
        $this->description = $car->description;
        $this->main_image = $car->main_image;
        

        if (!$car) {
            return redirect()->back()->with('error', 'Coche no encontrado.');
        }

        if ($this->main_image) {
            Storage::disk('public')->delete('img/' . $this->main_image);
        }

        $this->collection = CarImage::getSecondaryImagesByCarId($this);

        foreach ($this->collection as $image) {
            Storage::disk('public')->delete('img/' . $image->image);
        }

        if (Car::deleteCar($this)) {
            return redirect()->back()->with('success', 'Coche eliminado correctamente.');
        }

        return redirect()->back()->with('error', 'Error al eliminar el coche.');
    }

    public function addCar(StoreCarRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        
        $this->brand_id = $validatedData['brand'];
        $this->name = $validatedData['model'];
        $this->color_id = $validatedData['color'];
        $this->type_id = $validatedData['type_id'];
        $this->price = $validatedData['price'];
        $this->horse_power = $validatedData['horse_power'];
        $this->sale = $request->has('sale') ? 1 : 0;
        $this->year = $validatedData['year'];
        $this->description = $validatedData['description'];

        if ($request->hasFile('main_image')) {

            $this->main_image = 'main_' . time() . '.' . $request->file('main_image')->extension();
            $request->file('main_image')->storeAs('img/', $this->main_image, 'public');

        }

        $car = Car::createCar($this);

        if (!$car) {
            return redirect()->route('admin')->with('error', 'Error al agregar el coche.');
        }

        if ($request->hasFile('secondary_images')) {
            foreach ($request->file('secondary_images') as $image) {

                $this->secondaryImage = time() . '_' . uniqid() . '.' . $image->extension();
                $image->storeAs('img/', $this->secondaryImage, 'public');

                $carImage = new CarImage();
                $carImage->car_id = $car->id;
                $carImage->image = $this->secondaryImage;
                
                CarImage::storeImage($carImage);
            }
        }

        return redirect()->back()->with('success', 'Coche agregado correctamente.');
    }

    public function getCar(int $id): JsonResponse {

        $car = Car::findWithImages($id);

        $this->id = $car->id;
        $this->brand_id = $car->brand_id;
        $this->name = $car->name;
        $this->color_id = $car->color_id;
        $this->type_id = $car->type_id;
        $this->price = $car->price;
        $this->horse_power = $car->horse_power;
        $this->sale = $car->sale;
        $this->year = $car->year;
        $this->description = $car->description;
        $this->main_image = $car->main_image;
        $this->collection = $car->images;
    

        return response()->json($car);

    }

    public function updateCar(UpdateCarRequest $request): RedirectResponse {

        $validatedData = $request->validated();

        $this->id = $validatedData['car_id'];
        $this->brand_id = $validatedData['brand'];
        $this->name = $validatedData['model'];
        $this->color_id = $validatedData['color'];
        $this->type_id = $validatedData['type_id'];
        $this->price = $validatedData['price'];
        $this->horse_power = $validatedData['horse_power'];
        $this->sale = $request->has('sale') ? 1 : 0;
        $this->year = $validatedData['year'];
        $this->description = $validatedData['description'];

        if ($request->hasFile('main_image')) {

            $this->main_image = 'main_' . time() . '.' . $request->file('main_image')->extension();
            $request->file('main_image')->storeAs('img/', $this->main_image, 'public');

        }

        $updated = Car::updateCar($this);

        if (!$updated) {
            return redirect()->back()->with('error', 'Coche no encontrado o error al actualizar.');
        }

        if ($request->has('deleted_images')) {

            $deletedImages = explode(',', $request->input('deleted_images'));
            $this->secondaryImageDeleted = array_filter($deletedImages);

            $imagesToDelete = CarImage::getImagesByIds($this);
            CarImage::deleteSecondaryImages($this);

            foreach ($imagesToDelete as $image) {
                Storage::disk('public')->delete('img/' . $image->image);
            }
            
        }

        if ($request->hasFile('secondary_images')) {

            $images = $request->file('secondary_images');
        
            if (!is_array($images)) {
                $images = [$images];
            }
        
            foreach ($images as $imageId => $image) {

                $carImage = new CarImage();
                $carImage->car_id = $this->id;
                $carImage->image = time() . '_' . uniqid() . '.' . $image->extension();
        
                $image->storeAs('img/', $carImage->image, 'public');
        
                if (is_numeric($imageId)) {
                    $carImage->id = $imageId;
        
                    if (CarImage::imageExists($carImage)) {

                        $existingImage = CarImage::getImageById($carImage);
        
                        if ($existingImage) {
                            Storage::disk('public')->delete('img/' . $existingImage->image);
                        }
        
                        CarImage::updateImage($carImage);
                    } else {
                        CarImage::storeImage($carImage);
                    }
                } else {
                    CarImage::storeImage($carImage);
                }
            }
        }
        
        

        return redirect()->back()->with('success', 'Coche actualizado correctamente.');
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getBrand(): ?Brand {
        return $this->brand;
    }

    public function setBrand(Brand $brand): void {
        $this->brand = $brand;
    }

    public function getType(): ?Type {
        return $this->type;
    }

    public function setType(?Type $type): void {
        $this->type = $type;
    }

    public function getColor(): ?Color {
        return $this->color;
    }

    public function setColor(Color $color): void {
        $this->color = $color;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear(?int $year): void {
        $this->year = $year;
    }

    public function getHorsepower(): ?float {
        return $this->horse_power;
    }

    public function setHorsepower(?float $horsepower): void {
        $this->horse_power = $horsepower;
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(?float $price): void {
        $this->price = $price;
    }

    public function getMainImg(): ?string {
        return $this->main_image;
    }

    public function setMainImg(?string $main_image): void {
        $this->main_image = $main_image;
    }

    public function getSale(): ?string {
        return $this->sale;
    }

    public function setSale(?string $sale): void {
        $this->sale = $sale;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }
}
