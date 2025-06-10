<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTypeRequest;
use Illuminate\Support\Collection;
use App\Http\Requests\UpdateTypeRequest;

class TypeController extends Controller
{
    public ?int $id = NULL;
    public ?string $name = NULL;

    public function __construct(?Type $type = null){
        if ($type) {
            $this->id = $type->id;
            $this->name = $type->name;
        }
    }
    
    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function index():Collection {
        return Type::allTypes()->map(function($type): TypeController{
            return new TypeController($type);
        });
    }

    public function addType(StoreTypeRequest $request): RedirectResponse {
        $validated = $request->validated();

        $this->name = $validated['type'];

        if (Type::addType($this)) 
            return redirect()->back()->with('success', 'Tipo creado correctamente');
        
        return redirect()->back()->with('error', 'Algo ha salido mal, no se pudo crear el tipo');
    }

    public function deleteType(int $id): RedirectResponse {
        $type = Type::findType($id);

        $this->id = $type->id;
        $this->name = $type->name;

        if (Type::deleteType($this))
            return redirect()->back()->with('success', 'Tipo eliminado con éxito.');
        
        return redirect()->back()->with('error', 'Error al eliminar el tipo.');
    }

    public function updateType(UpdateTypeRequest $request): RedirectResponse {
        $validated = $request->validated();
        $this->id = $validated['type_id'];
        $this->name = $validated['type'];
        
        if (Type::editingType($this)) 
            return redirect()->back()->with('success', 'Tipo actualizado con éxito.');
        
        return redirect()->back()->with('error', 'Error al actualizar el tipo.');
    }
}
