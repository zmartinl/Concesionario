@extends('admin_layout')

@section('title', 'Colors')

@section('admin_active', 'active')

@section('content')

    <div class="container-fluid mt-4">
        <h2 class="text-white bg-dark p-4 custom-bg">Colores</h2>
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
            <thead class="text-center">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Hexadecimal</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                <tr>
                    <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar ID"></th>
                    <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Nombre"></th>
                    <th><input type="text" class="form-control form-control-sm search-column" placeholder="Buscar Hexadecimal"></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colors as $color)
                    <tr>
                        <td>{{ $color->id }}</td>
                        <td>{{ $color->name }}</td>
                        <td>{{ $color->hex }}</td>
                        <td>
                            <button class="btn custom-bg button-pers btn-sm editBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit"
                                data-id="{{ $color->id }}"
                                data-name="{{ $color->name }}"
                                data-hex="{{ $color->hex }}">
                                Editar
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" 
                                onclick="confirmDeleteColor({{ $color->id }}, '{{ $color->name }}')">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        
        <div class="d-flex justify-content-between mt-3">
            <div id="tableInfo"></div>
            <div id="tablePagination" class="d-flex"></div>
        </div>
    </div>
    @include('components.modals.colors.modalAdd')
    @include('components.modals.colors.modalEdit')
    @include('components.validations.sweet_alert')

   

@endsection

@push('js')

    <script src="{{ asset('js/sweetAlert.js') }}"></script>
    <script src="{{ asset('js/dataTable.js') }}"></script>
    <script type="module" src="{{ asset('js/initValidations.js') }}"></script>
       
@endpush
