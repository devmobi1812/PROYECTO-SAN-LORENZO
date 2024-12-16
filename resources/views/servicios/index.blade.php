@extends('template')
@section('titulo', 'Servicios')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Servicios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item active">Servicios</li>
        </ol>
        <a class="btn btn-primary mb-3" role="button" href="{{ route('servicio-crear') }}"><i
                class="fa-solid fa-circle-plus"></i> Cargar servicio</a>
        <a class="btn btn-outline-primary mb-3 imprimir" role="button" ><i class="fa-solid fa-print"></i> Imprimir</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Servicios
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Turno</th>
                            <th>Producto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                        <tr>
                            <td>{{$servicio->id}}</td>
                            <td>{{$servicio->nombre}}</td>
                            <td>${{$servicio->precio}}.-</td>
                            <td>
                                @if ($servicio->turno)
                                {{ $servicio->turno->nombre }}
                                @else
                                    Sin turno
                                @endif </td>
                            <td>{{ $servicio->producto->nombre }}</td>
                            <td>
                                <a href="{{ route('servicio-editar', $servicio->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                <a class="btn btn-danger" href="{{ route('servicio-borrar', $servicio->id)}}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
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
