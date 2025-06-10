<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreBrandRequest;
use Illuminate\Support\Collection;

class BrandController extends Controller {

    public ?int $id = NULL;
    public ?string $name = NULL;

    public function __construct(?Brand $brand = NULL) {

        if ($brand) {
            $this->id = $brand->id;
            $this->name = $brand->name;
        }
        
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function index(): Collection {
        
        return Brand::allBrands()->map(function($brand): BrandController{
            return new BrandController($brand);
        });
        
    }

    public function createBrand(StoreBrandRequest $request): RedirectResponse {
        
        $validated = $request->validated();
        
        $this->name = $validated['brand'];

        if (Brand::createBrand($this))
            return redirect()->back()->with('success', 'Marca creada con éxito');
        
        return redirect()->back()->with('error', 'Error al crear la marca');

    }

    public function deleteBrand(int $id): RedirectResponse {

        $brand = Brand::findBrand($id);
        
        $this->id = $brand->id;
        $this->name = $brand->name;

        if(Brand::deleteBrand($this))
            return redirect()->back()->with('success', 'Marca eliminada con éxito.');
        
        return redirect()->back()->with('error', 'Error al eliminar la marca.');

    }

    public function updateBrand(UpdateBrandRequest $request): RedirectResponse {

        $validated = $request->validated();

        $this->id = $validated['brand_id'];
        $this->name = $validated['brand'];

        if(Brand::editingBrand($this))
            return redirect()->back()->with('success', 'Marca actualizada con éxito.');
        
        return redirect()->back()->with('info', 'Error al realizar cambios en el Marca.');

    }
}
