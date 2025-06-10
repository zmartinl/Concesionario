<?php

use App\Http\Controllers\CarController;

use App\Http\Controllers\BrandController;

use App\Http\Controllers\TypeController;

use App\Http\Controllers\ColorController;

use App\Http\Controllers\CarsController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

Route::get('/', function (): View { 

    $carController = new CarsController();

    $cars = $carController->checkType();

    $brandController = new BrandController();
    $colorController = new ColorController();

    $brands = $brandController->index();
    $colors = $colorController->index();

    return view('Home.home')
            ->with('brands', $brands)
            ->with('colors', $colors)
            ->with('cars', $cars);

})->name('home');

// ------------------CARS------------------

Route::get('/admin', function (): View { 

    $carController = new CarsController('listCars');

    $cars = $carController->checkType();

    $brandController = new BrandController();
    $colorController = new ColorController();
    $typeController = new TypeController();

    $brands = $brandController->index();
    $colors = $colorController->index();
    $types = $typeController->index();

    return view('adminpanel.cars')
            ->with('brands', $brands)
            ->with('colors', $colors)
            ->with('types', $types)
            ->with('cars', $cars);

})->name('admin');

// ------------------CAR------------------

Route::get('/deleteCar/{id}', function ($id): RedirectResponse { 

    $controller = new CarController();

    return $controller->deleteCar($id); 

})->name('deleteCar');

Route::post('/addCar', function (StoreCarRequest $request): RedirectResponse { 

    $controller = new CarController();

    return $controller->addCar($request); 

})->name('addCar');


Route::put('/updateCar', function (UpdateCarRequest $request): RedirectResponse { 

    $controller = new CarController();

    return $controller->updateCar($request); 

})->name('updateCar');

Route::get('/tech-sheet/{id}', function ($id): View { 

    $controller = new CarController();

    return $controller->getTech($id); 

})->name('tech_sheet');


Route::get('/adminpanel/cars/{id}', function ($id): JsonResponse { 

    $controller = new CarController();

    return $controller->getCar($id); 

})->name('getCar');

// ------------------COLORS------------------

Route::get('/colors', function (): View { 

    $controller = new ColorController();
    $colors = $controller->index();

    return view('adminpanel.colors')
            ->with('colors', $colors);
    
})->name('colors');

Route::get('/deleteColor/{id}', function ($id): RedirectResponse { 

    $controller = new ColorController();

    return $controller->deleteColor($id);

})->name('colorDeleted');

Route::post('/addColor', function (StoreColorRequest $request): RedirectResponse { 

    $controller = new ColorController();
    return $controller->addColor($request);

})->name('addColor');

Route::put('/updateColor/', [ColorController::class, 'updateColor'])->name('colorUpdated');

// ------------------BRAND------------------

Route::get('/brand', function (): View { 

    $controller = new BrandController();
    $brands = $controller->index();
    return view('adminpanel.brand')->with('brands', $brands);
    
})->name('brand');

Route::get('/deleteBrand/{id}', function ($id): RedirectResponse { 

    $controller = new BrandController();
    return $controller->deleteBrand($id);

})->name('brandDeleted');

Route::post('/createBrand', function (StoreBrandRequest $request): RedirectResponse{ 
    
    $controller = new BrandController();
    return $controller->createBrand($request);

})->name('brandCreated');

Route::put('/updateBrand/', function (UpdateBrandRequest $request): RedirectResponse { 

    $controller = new BrandController();
    return $controller->updateBrand($request);   

})->name('brandUpdated');

// ------------------TYPES------------------

Route::get('/types', function (): View { 

    $controller = new TypeController();
    $types = $controller->index();
    return view('adminpanel.types')->with('types', $types);
    
})->name('types');

Route::post('/addType', function (StoreTypeRequest $request): RedirectResponse{ 
    
    $controller = new TypeController();
    return $controller->addType($request);

})->name('addType');

Route::get('/deleteType/{id}', function ($id): RedirectResponse { 

    $controller = new TypeController();
    return $controller->deleteType($id);

})->name('typeDeleted');


Route::put('/updateType/', function (UpdateTypeRequest $request): RedirectResponse { 

    $controller = new TypeController();
    return $controller->updateType($request);   

})->name('typeUpdated');

// ------------------IMAGES------------------

Route::get('/img/{main_image}', function ($main_image) {
    $path = storage_path('app/public/img/' . $main_image);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return Response::make($file, 200)->header('Content-Type', $type);
})->name('image');


