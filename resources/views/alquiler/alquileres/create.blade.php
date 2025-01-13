@extends('template')
@section('titulo', 'Crear alquiler')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Alquiler</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('alquileres') }} ">Alquiler</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('alquiler-guardar') }}">
            @csrf

          <div class="mb-3">
              <label for="nombre_id" class="form-label">Cliente</label>
                  <select class="form-select" name="nombre_id" id="">
                          <option value="">Seleccionar cliente</option>
                      @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}"
                                @if(old('nombre_id') == $cliente->id)
                                 selected
                                @endif 
                                @if ($cliente->socio)
                                    >{{$cliente->nombre ." - Socio"}}
                                @else
                                    >{{$cliente->nombre ." - No Socio"}}
                                @endif
                            </option>
                      @endforeach
                  </select>
                  @error('nombre_id')
                      <small class="text-danger"> {{ '*'.$message }}</small>
                  @enderror
                  <small>¿No es cliente?</small>
                  <a href="{{ route ("cliente-crear")}}">Crear</a>
          </div>

          <div class="mb-3">
            <label for="">Seleccionar fecha</label>
            <input class="form-control" type="date" id="fecha" name="fecha" value="{{ old("fecha") }}">
          </div>
          @error('fecha')
            <small class="text-danger"> {{ '*'.$message }}</small>
          @enderror
          
          <h4>¿Qué servicios deseas?</h4>
          <div class="mb-36">
                @foreach($productos as $index => $producto)
                    <label class="form-label">{{ $producto->nombre }}</label>
                    <input type="checkbox" name="servicios[{{$producto->id}}][selected]"  value="1" class="form-check-input checkbox-servicio" aria-describedby="emailHelp" @checked(old("servicios.{$producto->id}.selected"))>
                        @include('components.formServiceFragments.create'.$producto->tipoProducto->id, [
                            "producto" => $producto
                        ])
                @endforeach
          </div>
          
  
          
          
            <div class="mb-3">
                <label for="deposito" class="form-label">Deposito</label>
                    <select class="form-select" name="deposito" id="">
                            <option value="">Seleccionar deposito</option>
                        @foreach ($depositos as $deposito)
                            <option value="{{$deposito->id}}" @selected($deposito->id == old("deposito"))>{{$deposito->nombre}}</option>
                        @endforeach
                    </select>
                    @error('deposito')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
            
            </div>
            <div class="mb-3">
                <label for="descuento_id" class="form-label">Descuento</label>
                    <select class="form-select" name="descuento_id" id="descuento_id">
                            <option value="">Seleccionar descuento</option>
                        @foreach ($descuentos as $descuento)
                            <option value="{{$descuento->id}}" @selected($descuento->id == old("descuento_id")) >{{$descuento->nombre}}</option>
                        @endforeach
                    </select>
                    @error('descuento_id')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
            
            </div>
            <!-- Seña -->
            <label class="form-label">Abonar seña</label>
            <input type="checkbox" value="1" name="seña" class="checkbox-servicio form-check-input @error('seña') is-invalid @enderror"  @checked(old("seña")) >
            <div class="mb-3" id="seña-select-container" style="visibility: hidden; height: 0;">
                <label for="metodo_de_pagos_id" class="form-label">Seleccionar método de pago</label>
                <select class="form-select" name="metodo_de_pagos_id">
                        <option value="">Seleccionar aquí</option>  
                    @foreach ($metodos as $metodo)
                        <option value="{{$metodo->id}}" @selected($metodo->id == old("metodo_de_pagos_id")) >{{$metodo->nombre}}</option>
                    @endforeach
                </select>
                @error('metodo_de_pagos_id')
                    <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>


            <!-- Deposito -->
            <label class="form-label">Abonar depósito</label>
            <input type="checkbox" value="1" name="deposito_pago" class="checkbox-servicio form-check-input @error('deposito_pago') is-invalid @enderror"  @checked(old("deposito_pago")) >
            <div class="mb-3" id="seña-select-container" style="visibility: hidden; height: 0;">
                <label for="metodo_de_pago_deposito" class="form-label">Seleccionar método de pago</label>
                <select class="form-select" name="metodo_de_pago_deposito">
                        <option value="">Seleccionar aquí</option>  
                    @foreach ($metodos as $metodo)
                        <option value="{{$metodo->id}}" @selected($metodo->id == old("metodo_de_pago_deposito")) >{{$metodo->nombre}}</option>
                    @endforeach
                </select>
                @error('metodo_de_pago_deposito')
                    <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>
            
            <a href="{{ route('alquileres') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/alquileres.js') }}"></script>
    
    
@endpush