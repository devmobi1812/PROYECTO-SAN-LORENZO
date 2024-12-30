@extends('template')
@section('titulo', 'Editar alquiler')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Alquiler</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('alquileres') }} ">Alquiler</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('alquiler-actualizar', $alquiler->id) }}">
            @csrf

          <div class="mb-3">
              <label for="nombre_id" class="form-label">Cliente</label>
                  <select class="form-select" name="nombre_id" id="">
                      @foreach ($clientes as $cliente)
                          <option value="{{$cliente->id}}"
                                @if(old('nombre_id') != '' && old('nombre_id') == $cliente->id)
                                    selected
                                @elseif($alquiler->cliente && $alquiler->cliente->id == $cliente->id)
                                    selected
                                @endif 
                            >{{$cliente->nombre}}</option>
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
            <input class="form-control" type="date" id="fecha" name="fecha" value="{{ old('fecha') != '' ? old('fecha') : $alquiler->fecha }}">
          </div>
                    
            <div class="mb-3">
                <label for="deposito" class="form-label">Deposito</label>
                    <select class="form-select" name="deposito" id="">
                        @foreach ($depositos as $deposito)
                            <option value="{{$deposito->id}}"
                                @if(filled(old('deposito')) && old('deposito') == $deposito->id)
                                    selected
                                @elseif($alquiler->deposito && $alquiler->deposito == $deposito->cantidad)
                                    selected
                                @endif                                 
                                >{{$deposito->nombre}}</option>
                        @endforeach
                    </select>
                    @error('deposito')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
            
            </div>

            <div class="mb-3">
                <label for="descuento_id" class="form-label">Descuento</label>
                    <select class="form-select" name="descuento_id">
                        @foreach ($descuentos as $descuento)
                            <option value="{{$descuento->id}}"
                                @if(filled(old('descuento_id')) && old('descuento_id') == $descuento->id)
                                    selected
                                @elseif($alquiler->descuento && $alquiler->descuento == $descuento->cantidad)
                                    selected
                                @endif  
                                >{{$descuento->nombre}}</option>
                        @endforeach
                    </select>
                    @error('descuento_id')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
            
            </div>
            
            <a href="{{ route('alquileres') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/alquileres.js') }}"></script>
    
    
@endpush