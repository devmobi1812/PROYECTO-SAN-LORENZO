@extends('template')
@section('titulo', 'Crear alquiler')
@push('css')

@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Alquiler</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('depositos') }} ">Alquiler</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('deposito-guardar') }}">
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

          <div class="mb-3">
            <h4>¿Que servicio deseas?</h4>
            <div class="mb-3">
              <label for="quincho" class="form-label">Quincho
                <input type="checkbox" value="1" name="quincho" class="form-check-input @error('quincho') is-invalid @enderror" id="quincho-checkbox" aria-describedby="emailHelp" @if(old('quincho') == 1) checked @endif>
                <div class="mb-3" id="quincho-select-container" style="visibility: hidden; height: 0;">
                    <label for="nombre_id" class="form-label">Selecciona las variantes de quincho</label>
                    <select class="form-select" name="nombre_id" id="nombre_id">
                        <option value="">Selecciona aqui</option>
                        @foreach ($quinchos as $quincho)
                            <option value="{{$quincho->id}}">{{$quincho->nombre}}</option>
                        @endforeach
                    </select>
                    @error('nombre_id')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>
              </label>

              <label for="vajilla" class="form-label">Vajilla
                <input type="checkbox" value="1" name="vajilla" class="form-check-input @error('vajilla') is-invalid @enderror" id="vajilla-checkbox" aria-describedby="emailHelp" @if(old('vajilla') == 1) checked @endif>
                
                <!-- Contenedor de Vajilla -->
                <div class="mb-3" id="vajilla-input-container" style="visibility: hidden; height: 0;">
                    <label for="cantidad_vajilla" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad_vajilla" id="cantidad_vajilla" placeholder="Cantidad de vajilla" value="{{ old('cantidad_vajilla') }}">
                    @error('cantidad_vajilla')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>
              </label>

              <!-- Pileta -->
              <label for="pileta" class="form-label">Pileta
                <input type="checkbox" value="1" name="pileta" class="form-check-input @error('pileta') is-invalid @enderror" id="pileta-checkbox" aria-describedby="emailHelp" @if(old('pileta') == 1) checked @endif>
                
                <!-- Contenedor de Pileta -->
                <div class="mb-3" id="pileta-select-container" style="visibility: hidden; height: 0;">
                    <div class="mb-3 row">
                        <!-- Columna para el campo "Desde" -->
                        <div class="col-md-6">
                            <label for="desde" class="form-label">Desde <input type="time" name="desde" class="form-control @error('desde') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('desde') }}">
                              @error('desde')
                                  <small class="text-danger">{{ '*'.$message }}</small>
                              @enderror</label>
                            
                        </div>
                        
                        <!-- Columna para el campo "Hasta" -->
                        <div class="col-md-6">
                            <label for="hasta" class="form-label">Hasta <input type="time" name="hasta" class="form-control @error('hasta') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('hasta') }}">
                              @error('hasta')
                                  <small class="text-danger">{{ '*'.$message }}</small>
                              @enderror</label>
                            
                        </div>
                    </div>
                </div>
              </label>

            </div>  
          </div>
          
          <div class="mb-3">
            <label for="producto_id" class="form-label">Deposito</label>
                <select class="form-select" name="producto_id" id="">
                        <option value="">Seleccionar deposito</option>
                    @foreach ($depositos as $deposito)
                        <option value="{{$deposito->id}}" >{{$deposito->nombre}}</option>
                    @endforeach
                </select>
                @error('producto_id')
                    <small class="text-danger"> {{ '*'.$message }}</small>
                @enderror
            
        </div>
            
            <a href="{{ route('depositos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/alquileres.js') }}"></script>
@endpush