
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

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    
                    <div class="card-body">
                        <table class="table table-striped">
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
                                <tr>
                                    <th scope="row">Monto final con deposito</th>
                                    <td>${{$alquiler->monto_final+$alquiler->deposito}}.-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Monto del alquiler sin deposito</th>
                                    <td>${{$alquiler->monto_final}}.-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Monto pagado</th>
                                    <td>${{$alquiler->monto_final-$alquiler->monto_adeudado}}.-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Monto bruto adeudado (sin deposito)</th>
                                    @if($alquiler->monto_adeudado>=0) 
                                    <!--
                                          Supongamos que te alquilé 40 juegos de vajilla y al final tengo que pedir menos porque no viene tanta gente,
                                          yo ya pagué los 40 juegos. Ponele que ahora en vez de 40 necesito 20, ¿el sistema me va a seguir marcando que el
                                          club no adeuda nada al cliente si actualizo los valores?  
                                    -->
                                        <td>${{$alquiler->monto_adeudado}}.-</td>
                                    @else
                                        <td>$0.-</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th scope="row">Monto neto adeudado</th>
                                    <!-- PROPUESTA:
                                        - monto adeudado
                                        - monto final
                                        - monto deposito
                                        - estado deposito (pago, impago, devuelto, no devuelto) 
                                    -->
                                    <td>${{$alquiler->monto_adeudado+$alquiler->deposito}}.-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Valor del deposito</th>
                                    <td>${{$alquiler->deposito}}.-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descuento aplicado</th>
                                    <td>{{$alquiler->descuento}}%</td>
                                </tr>
                                <tr>
                                    <th scope="row">Estado actual</th>
                                    <td>
                                        <!-- ESTADO ACTUAL DEL ALQUILER -->
                                        <a href=""
                                        @if($alquiler->estado->nombre=="Impago")
                                            class="btn btn-danger " style="pointer-events: none;"
                                        @else
                                            class="btn btn-success" style="pointer-events: none;"
                                        @endif>
                                        Alquiler Bruto {{$alquiler->estado->nombre}}
                                        </a>
                                        <!-- ESTADO ACTUAL DEL DEPOSITO -->

                                        <!-- No representa el estado del deposito, si no que representa si se pagó el alquiler y el deposito.
                                            Ademas el deposito NO está incluido en el monto final en la base de datos,
                                            para dejarlo mas acomodado para el balance a futuro es ideal.
                                            PD: no podes agregar un abono que sea el deposito puesto que se 
                                            descuajeringa todo el balance(si le devolvimos el depoosito sigue quedando como que tenemos los 15000 por ejemplo) -->
                                        <a href=""
                                        @if(($alquiler->monto_adeudado+$alquiler->deposito)>0)
                                            class="btn btn-danger " style="pointer-events: none;">Alquiler Neto Impago</a>
                                        @else
                                            class="btn btn-success" style="pointer-events: none;">Alquiler Neto Pago</a>
                                        @endif
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <a class="btn btn-primary mb-3" role="button" href="{{ route('recibo-crear', $alquiler->id)}}"><i
                        class="fa-solid fa-circle-plus"></i> Cargar servicio al alquiler</a>
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i> 
                        Recibo del alquiler
                   </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-striped">
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
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Abonos de alquiler
                    </div>
                    <div class="card-body">                
                        <table id="datatablesSimple" class="table table-striped">
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
                                    <a href="{{ route('abono-editar', $abono->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-pen-to-square"></i></a><!--BOTON EDITAR-->
                                    <a class="btn btn-danger" href="{{ route('abono-borrar', $abono->id)}}"><i class="fa-solid fa-trash"></i></a><!--BOTON ELIMINAR-->
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
