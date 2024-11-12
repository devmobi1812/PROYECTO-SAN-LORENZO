@extends('template')
@section('titulo', 'Recibos')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Recibos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" >Alquileres</a></li>
            <li class="breadcrumb-item active">Recibos</li>
        </ol>
        <a class="btn btn-primary mb-3" role="button" href="{{ route('recibo-crear') }}"><i
                class="fa-solid fa-circle-plus"></i> Cargar Recibo</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Recibos
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recibos as $recibo)
                        <tr>
                            <td>{{$recibo->id}}</td>
                            <td>{{$recibo->servicio_nombre}}</td>
                            <td>{{$recibo->servicio_precio}}</td>
                            <td>{{$recibo->servicio_cantidad}}</td>
                            <td>{{$recibo->desde}}</td>
                            <td>{{$recibo->hasta}}</td>
                            
                            <td>
                                <a href="{{ route('recibo-editar', $recibo->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                <a class="btn btn-danger" href="{{ route('recibo-borrar', $recibo->id)}}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
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
    <script src="{{ asset('js/sweet-alert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
