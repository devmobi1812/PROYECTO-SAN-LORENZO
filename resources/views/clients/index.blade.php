@extends('template')
@section('titulo', 'Clientes')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Clientes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <a class="btn btn-primary mb-3" role="button" href="{{ route('cliente-crear') }}"><i
                class="fa-solid fa-circle-plus"></i> Cargar cliente</a>
        <a class="btn btn-outline-primary mb-3 imprimir" role="button" ><i class="fa-solid fa-print"></i> Imprimir</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Clientes
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Socio</th>
                            <th>Contacto</th>
                            <th>Domicilio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nombre}}</td>
                            <td>{{$cliente->dni}}</td>
                            @if ($cliente->socio==1)
                            <td>Si</td> 
                            @else
                            <td>No</td>
                            @endif
                            <td>{{$cliente->contacto}}</td>
                            <td>{{$cliente->domicilio}}</td>
                            <td>
                                <a href="{{ route('cliente-editar', $cliente->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                <a class="btn btn-danger" href="{{ route('cliente-borrar', $cliente->id) }}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="{{ asset('js/impresion.js') }}"></script>
    
    
@endpush
