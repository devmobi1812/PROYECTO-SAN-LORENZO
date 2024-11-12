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
                          <option value="{{$cliente->id}}" socio="{{$cliente->socio}}" >{{$cliente->nombre}}</option>
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
            <input class="form-control" type="date" id="fecha" name="fecha">
          </div>

          
          <h4>¿Qué servicio deseas?</h4>
          <div class="mb-36">
              <!-- Quincho -->
              <label for="quincho" class="form-label">Quincho</label>
              <input type="checkbox" value="1" name="quincho" class="form-check-input @error('servicios.0.nombre') is-invalid @enderror" id="quincho-checkbox" aria-describedby="emailHelp" @if(old('servicios.0.nombre') == 'Quincho') checked @endif>
              <div class="mb-3" id="quincho-select-container" style="visibility: hidden; height: 0;">
                  <label for="quincho_variantes" class="form-label">Selecciona las variantes de quincho</label>
                  <select class="form-select" name="quincho_id" id="quincho_variantes">
                      <option value="">Selecciona aquí</option>
                      @foreach ($quinchos as $quincho)
                          <option value="{{ $quincho->id }}" @if(old('quincho_id') == $quincho->id) selected @endif>{{ $quincho->nombre }}</option>
                      @endforeach
                  </select>
                  @error('quincho_id')
                      <small class="text-danger">{{ '*'.$message }}</small>
                  @enderror
              </div>
          
              <!-- Vajilla -->
              <label for="vajilla" class="form-label">Vajilla</label>
              <input type="checkbox" value="1" name="vajilla" class="form-check-input @error('servicios.1.nombre') is-invalid @enderror" id="vajilla-checkbox" aria-describedby="emailHelp" @if(old('servicios.1.nombre') == 'Vajilla') checked @endif>
              <div class="mb-3" id="vajilla-input-container" style="visibility: hidden; height: 0;">
                  <label for="cantidad" class="form-label">Cantidad</label>
                  <input type="number" placeholder="Ingrese un número" class="form-control" name="servicio_cantidad" id="servicio_cantidad" placeholder="Cantidad de vajilla" value="{{ old('servicio_cantidad') }}">
                  @error('servicio_cantidad')
                      <small class="text-danger">{{ '*'.$message }}</small>
                  @enderror
              </div>
          
              <!-- Pileta -->
              <label for="pileta" class="form-label">Pileta</label>
              <input type="checkbox" value="1" name="pileta" class="form-check-input @error('pileta') is-invalid @enderror" id="pileta-checkbox" aria-describedby="emailHelp" @if(old('pileta') == 'Pileta') checked @endif>
              <div class="mb-3" id="pileta-select-container" style="visibility: hidden; height: 0;">
                  <div class="mb-3 row">
                      <div class="col-md-6">
                          <label for="desde" class="form-label">Desde</label>
                          <input type="time" name="desde" class="form-control @error('desde') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('desde') }}">
                          @error('desde')
                              <small class="text-danger">{{ '*'.$message }}</small>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="hasta" class="form-label">Hasta</label>
                          <input type="time" name="hasta" class="form-control @error('hasta') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('hasta') }}">
                          @error('hasta')
                              <small class="text-danger">{{ '*'.$message }}</small>
                          @enderror
                      </div>
                  </div>
              </div>
          </div>
          
  
          
          
            <div class="mb-3">
                <label for="deposito" class="form-label">Deposito</label>
                    <select class="form-select" name="deposito" id="">
                            <option value="">Seleccionar deposito</option>
                        @foreach ($depositos as $deposito)
                            <option value="{{$deposito->monto}}" >{{$deposito->nombre}}</option>
                        @endforeach
                    </select>
                    @error('deposito')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
            
            </div>
            <div class="mb-3">
                <label for="descuento" class="form-label">Descuento</label>
                    <select class="form-select" name="descuento_id" id="descuento_id">
                            <option value="">Seleccionar descuento</option>
                        @foreach ($descuentos as $descuento)
                            <option value="{{$descuento->id}}" >{{$descuento->nombre}}</option>
                        @endforeach
                    </select>
                    @error('descuento')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
            
            </div>
            <!-- Seña -->
            <label for="quincho" class="form-label">Abonar seña</label>
            <input type="checkbox" value="1" name="seña" class="form-check-input @error('seña') is-invalid @enderror" id="seña-checkbox" aria-describedby="emailHelp" @if(old('seña') == 'seña') checked @endif>
            <div class="mb-3" id="seña-select-container" style="visibility: hidden; height: 0;">
                <label for="seña" class="form-label">Seleccionar metodo</label>
                <select class="form-select" name="metodo_de_pagos_id" id="">
                        <option value="">Seleccionar aqui</option>  
                    @foreach ($metodos as $metodo)
                        <option value="{{$metodo->id}}" >{{$metodo->nombre}}</option>
                    @endforeach
                </select>
                @error('metodo_de_pagos_id')
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