<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class ColorController extends Controller {

    public ?int $id = NULL;
    public ?string $name = NULL;
    public ?string $hex = NULL;

    public function __construct(?Color $color = null){
        if ($color) {
            $this->id = $color->id;
            $this->name = $color->name;
            $this->hex = $color->hex;
        }
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getHex(): ?string {
        return $this->hex;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setHex(string $hex): void {
        $this->hex = $hex;
    }


    public function index(): Collection {
        return Color::allColors()->map(function($color){
            return new ColorController($color);
        });
    }
    
    public function addColor(StoreColorRequest $request): RedirectResponse {
        $validated = $request->validated();

        $this->name = $validated['name'];
        $this->hex = $validated['hex'];

        if (Color::addColor($this)) 
            return redirect()->back()->with('success', 'Color creado correctamente');
        
        return redirect()->back()->with('error', 'Error al crear el color');
    }


    public function deleteColor(int $id): RedirectResponse {
        
        $color = Color::findColor($id);
        
        $this->id = $color->id;
        $this->name = $color->name;
        $this->hex = $color->hex;
        
        if(Color::deleteColor($this))
            return redirect()->back()->with('success', 'Color eliminado con éxito.');
        
        return redirect()->back()->with('error', 'Error al eliminar el Color.');

    }

    public function updateColor(UpdateColorRequest $request): RedirectResponse {
        
        $validated = $request->validated();

        $this->id = $validated['color_id'];
        $this->name = $validated['name'];
        $this->hex = $validated['hex'];

        if(Color::editingColor($this))
            return redirect()->back()->with('success', 'Color actualizado con éxito.');
        
        return redirect()->back()->with('info', 'No se realizaron cambios en el color.');

    }
}
