@extends('template')
@section('titulo', 'Alquileres')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Historicos de alquileres</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('alquileres') }} ">Alquileres</a></li>
            <li class="breadcrumb-item active">Historicos</li>
        </ol>
        <a class="btn btn-outline-primary mb-3 imprimir" role="button" ><i class="fa-solid fa-print"></i> Imprimir historicos</a>
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
                            <th>Servicios</th>
                            <th>Cliente</th>
                            <th>Horario</th>
                            <th>Fecha</th>
                            <th>Monto Final</th>
                            <th>Monto Adeudado</th>
                            <th>Deposito</th>
                            <th>Descuento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alquileres as $alquiler)
                        <tr>
                            <td>{{$alquiler->id}}</td>
                            <td> @foreach ($servicios as $servicio) 
                                    @if ($servicio->alquiler_id == $alquiler->id) 
                                        {{$servicio->servicio_nombre .","}} 
                                    @endif 
                                @endforeach 
                            </td>
                            <td>{{$alquiler->cliente->nombre}}</td>
                            <td>
                                @php
                                    $existe = 0;
                                @endphp
                                @foreach ($servicios as $servicio)
                                    @if ($servicio->alquiler_id == $alquiler->id && $existe == 0)
                                        {{ substr($servicio->desde, 0, 5) . "hs - " . substr($servicio->hasta, 0, 5) . "hs" }}
                                        @php
                                            $existe = 1;
                                        @endphp
                                    @endif
                                @endforeach
                            </td>
                            
                            <td>{{$alquiler->dia->nombre ." ". $alquiler->fecha}}</td>
                            <td>${{$alquiler->monto_final}}.-</td>
                            <td>${{$alquiler->monto_adeudado}}.-</td>
                            <td>${{$alquiler->deposito}}.-</td>
                            <td>{{$alquiler->descuento}}%</td>

                            <td>
                                <a href=""
                                   @if($alquiler->estado->nombre=="Impago")
                                       class="btn btn-danger " style="pointer-events: none;"
                                   @else
                                       class="btn btn-success" style="pointer-events: none;"
                                   @endif>
                                   {{$alquiler->estado->nombre}}
                                </a>
                            </td>
                            

                            <td>
                                <a href="{{ route('alquiler-ver', $alquiler->id)}}" type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a><!--BOTON DE VER-->
                                <a href="{{ route('abono-crear', $alquiler->id)}}" type="button" class="btn btn-success"><i class="fa-solid fa-money-bill"></i></a> <!--BOTON DE CREAR ABONO-->
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