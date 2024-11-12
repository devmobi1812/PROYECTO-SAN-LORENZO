@extends('template')
@section('titulo', 'Turnos')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Turnos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item active">Turnos</li>
        </ol>
        <a class="btn btn-primary mb-3" role="button" href="{{ route('turno-crear') }}"><i
                class="fa-solid fa-circle-plus"></i> Cargar turno</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Turnos
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--TODO: Recortar los segundos de la tabla de horarios-->
                        @foreach ($turnos as $turno)
                        <tr>
                            <td>{{$turno->id}}</td>
                            <td>{{$turno->nombre}}</td>
                            <td>{{substr($turno->desde, 0, 5)}} hs</td>
                            <td>{{substr($turno->hasta, 0, 5)}} hs</td>
                            <td>
                                <a href="{{ route('turno-editar', $turno->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                <a class="btn btn-danger" href="{{ route('turno-borrar', $turno->id) }}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
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
    
    
@endpush
