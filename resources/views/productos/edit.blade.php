@extends('template')
@section('titulo', 'Editar producto')
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
        <form method="POST" action="{{ route('producto-actualizar', $producto->id) }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre </label>
                <input type="text" placeholder="Ingrese el nombre del producto" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre')=="" ? $producto->nombre : old('nombre') }}">
                @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>

            <div class="mb-3">
                <label for="tipo_producto_id" class="form-label">Tipo de producto</label>
                <select class="form-select" name="tipo_producto_id" id="">  
                    @foreach($tiposDeProducto as $tipo)
                        <option value="{{$tipo->id}}" 
                            @if(old('tipo_producto_id') == $tipo->id)
                                selected
                            @elseif(old('tipo_producto_id') == '' && $tipo->id == $producto->tipoProducto->id)
                                selected
                            @endif
                            >{{$tipo->nombre}}</option>
                    @endforeach
                </select>
                @error('tipo_producto_id')
                    <small class="text-danger"> {{ '*'.$message}}</small>
                @enderror
            </div>

            <a href="{{ route('productos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush