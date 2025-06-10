@extends('admin_layout')

@section('title', 'Cars')

@section('admin_active', 'active')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-white bg-dark p-4 custom-bg">Vehículos</h2>

    <div class="mb-3 d-flex justify-content-between mt-4">
        <div>
            <label for="entries">Mostrar</label>
            <select id="entries" class="form-select d-inline-block w-auto mx-2 custom-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="todos">Todos</option>
            </select>
            registros
        </div>
        <div>
            <button class="btn custom-bg button-pers" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar</button>
        </div>
    </div>

    <table id="infoTable" class="table text-center table-bordered custom-table">
        <thead class="table-light">
            <tr class="text-center">
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Color</th>
                <th>Potencia</th>
                <th>Año</th>
                <th>Oferta</th>
                <th>Descripción</th>
                <th>Archivos</th>
                <th>Precio</th> <th>Editor</th>
                <th>Eliminar</th>
            </tr>
            <tr>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar ID"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Nombre"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Marca"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Tipo"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Color"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Potencia"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Año"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Oferta"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Descripción"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Archivos"></th>
                <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Precio"></th> <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr class="align-middle">
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->brand->name }}</td>
                    <td>{{ $car->type->name }}</td>
                    <td>{{ $car->color->name }}</td>
                    <td>{{ $car->horse_power }} CV</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->sale ? 'Sí' : 'No' }}</td>
                    <td>{{ $car->description }}</td>
                    <td>{{ $car->main_image }}</td>
                    <td>{{ $car->price }}€</td> 
                    <td>@include('components.editCar_button')</td>
                    <td>@include('components.deleteCar_button')</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <div id="tableInfo"></div>
        <div id="tablePagination" class="d-flex"></div>
    </div>
</div>

@include('components.modals.cars.modalAdd')
@include('components.modals.cars.modalEdit')
@include('components.validations.sweet_alert')

@endsection

@push('js')
    <script src="{{ asset('js/dataTable.js') }}"></script>
    <script src="{{ asset('js/cars.js') }}"></script>
    <script type="module" src="{{ asset('js/initValidationsCar.js') }}"></script>
    <script src="{{ asset('js/sweetAlert.js') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('css/cars.css') }}">
@endpush