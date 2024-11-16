@extends('template')
@section('titulo', 'Crear producto')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Producto</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('productos') }} ">Productos</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('producto-guardar') }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" placeholder="Ingrese el nombre del producto" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('dni') }}">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            
            <div class="mb-3">
                <label for="tipo_producto_id" class="form-label">Tipo de producto</label>
                <select class="form-select" name="tipo_producto_id" id="">
                        <option value="">Seleccionar tipo de producto</option>  
                    @foreach ($tiposDeProducto as $tipo)
                        <option value="{{$tipo->id}}" >{{$tipo->nombre}}</option>
                    @endforeach
                </select>
                @error('tipo_pproducto')
                    <small class="text-danger"> {{ '*'.$message}}</small>
                @enderror
            </div>
        
            <a href="{{ route('productos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush