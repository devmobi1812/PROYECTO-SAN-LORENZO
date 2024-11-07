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
                          <option value="{{$cliente->id}}" >{{$cliente->nombre}}</option>
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
              <input type="checkbox" value="Quincho" name="servicios[0][nombre]" class="form-check-input @error('servicios.0.nombre') is-invalid @enderror" id="quincho-checkbox" aria-describedby="emailHelp" @if(old('servicios.0.nombre') == 'Quincho') checked @endif>
              <div class="mb-3" id="quincho-select-container" style="visibility: hidden; height: 0;">
                  <label for="quincho_variantes" class="form-label">Selecciona las variantes de quincho</label>
                  <select class="form-select" name="servicios[0][precio]" id="quincho_variantes">
                      <option value="">Selecciona aquí</option>
                      @foreach ($quinchos as $quincho)
                          <option value="{{ $quincho->precio }}" @if(old('servicios.0.precio') == $quincho->precio) selected @endif>{{ $quincho->nombre }}</option>
                      @endforeach
                  </select>
                  @error('servicios.0.precio')
                      <small class="text-danger">{{ '*'.$message }}</small>
                  @enderror
                  <input type="hidden" name="servicios[0][precio]" value="{{ $quincho->precio }}">
                  <input type="hidden" name="servicios[0][nombre]" value="$quincho->nombre">
                  <input type="hidden" name="servicios[0][cantidad]" value="1">
                  <input type="hidden" name="servicios[0][deposito]" value="0">
                  <input type="hidden" name="servicios[0][desde]" value="">
                  <input type="hidden" name="servicios[0][hasta]" value="">
              </div>
          
              <!-- Vajilla -->
              <label for="vajilla" class="form-label">Vajilla</label>
              <input type="checkbox" value="Vajilla" name="servicios[1][nombre]" class="form-check-input @error('servicios.1.nombre') is-invalid @enderror" id="vajilla-checkbox" aria-describedby="emailHelp" @if(old('servicios.1.nombre') == 'Vajilla') checked @endif>
              <div class="mb-3" id="vajilla-input-container" style="visibility: hidden; height: 0;">
                  <label for="cantidad" class="form-label">Cantidad</label>
                  <input type="number" class="form-control" name="servicios[1][cantidad]" id="cantidad_vajilla" placeholder="Cantidad de vajilla" value="{{ old('servicios.1.cantidad') }}">
                  @error('servicios.1.cantidad')
                      <small class="text-danger">{{ '*'.$message }}</small>
                  @enderror
                  <input type="hidden" name="servicios[1][nombre]" value="Vajilla"> <!-- Define un precio de ejemplo -->
                  <input type="hidden" name="servicios[1][precio]" value="50"> <!-- Define un precio de ejemplo -->
                  <input type="hidden" name="servicios[1][deposito]" value="0">
                  <input type="hidden" name="servicios[1][desde]" value="12:00">
                  <input type="hidden" name="servicios[1][hasta]" value="18:00">
              </div>
          
              <!-- Pileta -->
              <label for="pileta" class="form-label">Pileta</label>
              <input type="checkbox" value="Pileta" name="servicios[2][nombre]" class="form-check-input @error('servicios.2.nombre') is-invalid @enderror" id="pileta-checkbox" aria-describedby="emailHelp" @if(old('servicios.2.nombre') == 'Pileta') checked @endif>
              <div class="mb-3" id="pileta-select-container" style="visibility: hidden; height: 0;">
                  <div class="mb-3 row">
                      <div class="col-md-6">
                          <label for="desde" class="form-label">Desde</label>
                          <input type="time" name="servicios[2][desde]" class="form-control @error('servicios.2.desde') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('servicios.2.desde') }}">
                          @error('servicios.2.desde')
                              <small class="text-danger">{{ '*'.$message }}</small>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <label for="hasta" class="form-label">Hasta</label>
                          <input type="time" name="servicios[2][hasta]" class="form-control @error('servicios.2.hasta') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('servicios.2.hasta') }}">
                          @error('servicios.2.hasta')
                              <small class="text-danger">{{ '*'.$message }}</small>
                          @enderror
                      </div>
                  </div>
                  <input type="hidden" name="servicios[2][nombre]" value="Pileta"> <!-- Define un precio de ejemplo -->
                  <input type="hidden" name="servicios[2][precio]" value="$quincho->precio"> <!-- Define un precio de ejemplo -->
                  <input type="hidden" name="servicios[2][cantidad]" value="1">
                  <input type="hidden" name="servicios[2][deposito]" value="0">
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
                    <select class="form-select" name="descuento_id" id="">
                            <option value="">Seleccionar descuento</option>
                        @foreach ($descuentos as $descuento)
                            <option value="{{$descuento->id}}" >{{$descuento->nombre}}</option>
                        @endforeach
                    </select>
                    @error('descuento')
                        <small class="text-danger"> {{ '*'.$message }}</small>
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