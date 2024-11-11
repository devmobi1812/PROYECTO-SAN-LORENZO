@extends('template')
@section('titulo', 'Depositos')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Alquiler</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item active">Alquileres</li>
        </ol>
        <a class="btn btn-primary mb-3" role="button" href="{{ route('alquiler-crear') }}"><i
                class="fa-solid fa-circle-plus"></i> Cargar alquiler</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Alquiler
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Dia</th>
                            <th>Descuento</th>
                            <th>Estado</th>
                            <th>Monto Final</th>
                            <th>Monto Adeudado</th>
                            <th>Deposito</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--TODO: Recortar los segundos de la tabla de horarios-->
                        @foreach ($alquileres as $alquiler)
                        <tr>
                            <td>{{$alquiler->id}}</td>
                            <td>{{$alquiler->cliente->nombre}}</td>
                            <td>{{$alquiler->dia->nombre}}</td>
                            <td>{{$alquiler->descuento->nombre}}</td>

                            <td>
                                <a href=""
                                   @if($alquiler->estado->nombre=="Inpago")
                                       class="btn btn-danger " style="pointer-events: none;"
                                   @else
                                       class="btn btn-success" style="pointer-events: none;"
                                   @endif>
                                   {{$alquiler->estado->nombre}}
                                </a>
                            </td>
                            

                            <td>${{$alquiler->monto_final}}.-</td>
                            <td>${{$alquiler->monto_adeudado}}.-</td>
                            <td>${{$alquiler->deposito}}.-</td>
                            <td>{{$alquiler->fecha}}</td>
                            <td>
                                <a href="{{ route('abonos', $alquiler->id)}}" type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a><!--BOTON DE VER-->
                                <a href="{{ route('abono-crear', $alquiler->id)}}" type="button" class="btn btn-success"><i class="fa-solid fa-money-bill"></i></a> <!--BOTON DE CREAR ABONO-->
                                <a href="{{ route('alquiler-editar', $alquiler->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                <a class="btn btn-danger" href="{{ route('alquiler-borrar', $alquiler->id) }}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
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
