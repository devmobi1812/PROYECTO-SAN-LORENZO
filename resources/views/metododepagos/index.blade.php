@extends('template')
@section('titulo', 'Metodos de pago')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Metodos de pago</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item active">Metodos De Pago</li>
        </ol>
        <a class="btn btn-primary mb-3" role="button" href="{{ route('metododepago-crear') }}"><i
                class="fa-solid fa-circle-plus"></i> Cargar Metodo De Pago</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Metodos De Pago
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--TODO: Recortar los segundos de la tabla de horarios-->
                        @foreach ($metododepagos as $metododepago)
                        <tr>
                            <td>{{$metododepago->id}}</td>
                            <td>{{$metododepago->nombre}}</td>
                            <td>
                                <a href="{{ route('metododepago-editar', $metododepago->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                <a class="btn btn-danger" href="{{ route('metododepago-borrar', $metododepago->id) }}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
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
