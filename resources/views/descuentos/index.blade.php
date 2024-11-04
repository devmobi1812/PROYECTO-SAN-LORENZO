@extends('template')
@section('titulo', 'Panel')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Descuentos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item active">Descuentos</li>
        </ol>
        <a class="btn btn-primary mb-3" role="button" href="{{ route('descuento-crear') }}"><i
                class="fa-solid fa-circle-plus"></i> Cargar descuento</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Descuentos
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--TODO: Recortar los segundos de la tabla de horarios-->
                        @foreach ($descuentos as $descuento)
                        <tr>
                            <td>{{$descuento->id}}</td>
                            <td>{{$descuento->nombre}}</td>
                            <td>{{$descuento->cantidad}}</td>
                            <td>
                                <a href="{{ route('descuento-editar', $descuento->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                <a class="btn btn-danger" href="{{ route('descuento-borrar', $descuento->id) }}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
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
