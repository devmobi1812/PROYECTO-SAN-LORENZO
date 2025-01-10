
@extends('template')
@section('titulo', 'Detalles del alquiler')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detalles del alquiler</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('alquileres') }} ">Alquileres</a></li>
            <li class="breadcrumb-item active">Ver</li>
        </ol>
        
        <a class="btn btn-outline-primary mb-3 imprimir" role="button" ><i class="fa-solid fa-print"></i> Imprimir recibo</a>
        <a href="{{ route('alquiler-editar', $alquiler->id) }}" class="btn btn-warning mb-3 float-end" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->

        <div class="row">
            <!-- DATOS DEL ALQUILER-->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fa-solid fa-database"></i> Datos del alquiler</div>
                    <div class="card-body p-0">
                        <table class="table table-striped m-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Alquiler Nº</th>
                                    <td>{{$alquiler->id}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha</th>
                                    <td>{{$alquiler->fecha}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Horario</th>
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
                                </tr>
                                <tr>
                                    <th scope="row">Cliente</th>
                                    <td>{{$alquiler->cliente->nombre}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- RECIBO -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fa-solid fa-receipt"></i> Recibo del alquiler</div>
                    <div class="card-body p-0">
                        <table class="table table-striped m-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Servicios</th>
                                    <td>${{$alquiler->monto_final}}.-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Depósito</th>
                                    <td>${{$alquiler->deposito}}.-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descuento aplicado</th>
                                    <td>{{$alquiler->descuento}}%</td>
                                </tr>
                                <tr>
                                    <th scope="row">Monto final</th>
                                    <td>${{$alquiler->monto_final+$alquiler->deposito}}.-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('pagar-deposito', $alquiler->id) }}" class="btn btn-success mb-3 ms-1">Pagar depósito</a>
                <a href="{{ route('reembolsar-deposito', $alquiler->id) }}" class="btn btn-info mb-3 ms-1">Reembolsar depósito</a>
                <a href="{{ route('retener-deposito', $alquiler->id) }}" class="btn btn-warning mb-3 ms-1">Retener depósito</a>
            </div>
            <!-- ESTADO -->
            <div class="row mx-0 px-0">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fa-solid fa-file-invoice-dollar"></i> Estado actual del alquiler</div>
                        <div class="card-body p-0">
                            <table class="table table-striped m-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Monto pagado</th>
                                        <td>${{$alquiler->monto_final - $alquiler->monto_adeudado}}.-</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Monto adeudado</th>
                                        <td>${{$alquiler->monto_adeudado + (($alquiler->estadoDeposito->id != 3) ? $alquiler->deposito : 0)}}.-</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Estado actual</th>
                                        <td>
                                            <a href="" class="btn 
                                            @switch($alquiler->estadoAlquiler->id)
                                                @case(1)
                                                    btn-success
                                                    @break
                                                @case(2)
                                                    btn-danger
                                                    @break
                                            @endswitch " style="pointer-events: none;">{{$alquiler->estadoAlquiler->nombre}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Estado del depósito</th>
                                        <td>
                                            <a href="" class="btn 
                                            @switch($alquiler->estadoDeposito->id)
                                                @case(1)
                                                    btn-success
                                                    @break
                                                @case(2)
                                                    btn-danger
                                                    @break
                                                @case(3)
                                                    btn-info
                                                    @break
                                                @case(4)
                                                    btn-warning
                                                    @break
                                                @endswitch " style="pointer-events: none;">{{$alquiler->estadoDeposito->nombre}}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0 px-0">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <a class="btn btn-primary mb-3" role="button" href="{{ route('recibo-crear', $alquiler->id)}}"><i
                        class="fa-solid fa-circle-plus"></i> Cargar servicio al alquiler</a>
                    <div class="card-header"><i class="fas fa-chart-area me-1"></i>Servicios del alquiler</div>
                    <div class="card-body p-0">
                        <table id="datatablesSimple" class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Servicio</th>
                                    <th>Precio unitario</th>
                                    <th>Precio final</th>
                                    <th>Cantidad</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alquiler->alquilerRecibos as $recibo)
                                <tr>
                                    <td>{{$recibo->id}}</td>
                                    <td>{{$recibo->servicio_nombre}}</td>
                                    <td>${{$recibo->servicio_precio - ($recibo->servicio_precio * $alquiler->descuento / 100)}}.-</td>
                                    <td>${{$recibo->servicio_precio*$recibo->servicio_cantidad-(($recibo->servicio_precio*$recibo->servicio_cantidad) * $alquiler->descuento / 100)}}.-</td>
                                    <td>{{$recibo->servicio_cantidad}}</td>
                                    <td>
                                        {{ substr($recibo->desde, 0, 5) . "hs"}}
                                    </td>
                                    <td>
                                        {{substr($recibo->hasta, 0, 5) . "hs" }}
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ route('recibo-borrar', $recibo->id)}}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
                                    </td>
                                </tr>
                                @endforeach
        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <a class="btn btn-success mb-3" role="button" href="{{ route('abono-crear', $alquiler->id)}}" ><i class="fa-solid fa-money-bill"></i> Cargar abono</a>
                    <div class="card-header"><i class="fas fa-chart-bar me-1"></i>Abonos de alquiler</div>
                    <div class="table-body p-0">                
                        <table id="datatablesSimple" class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Monto</th>
                                    <th>Metodo</th>
                                    <th>Detalle</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alquiler->alquilerAbonos as $abono)
                                <tr>
                                    <td>{{$abono->id}}</td>
                                    <td>${{$abono->monto_pagado }}.-</td>
                                    <td>{{$abono->metodoDePago->nombre}}</td>
                                    <td>{{$abono->detalle}}</td>
                                    <td>{{$abono->created_at->format('d/m/Y')}}</td>
                                    <td>
                                        @if(!$abono->es_deposito)
                                            <a href="{{ route('abono-editar', $abono->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                            <a class="btn btn-danger" href="{{ route('abono-borrar', $abono->id)}}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
                                        @endif
                                   </td>
                                </tr>
                                @endforeach
        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/alquileres.js') }}"></script>
    <script src="{{ asset('js/impresion.js') }}"></script>
    
@endpush
