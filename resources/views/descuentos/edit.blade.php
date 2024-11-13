@extends('template')
@section('titulo', 'Editar descuento')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Descuento</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('descuentos') }} ">Descuentos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('descuento-actualizar', $descuento->id) }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" placeholder="Ingrese el nombre del descuento (ej: %30)" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre') == "" ? $descuento->nombre : old('nombre') }}">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text" placeholder="Ingrese el descuento (ej: %30)" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('cantidad') == "" ? $descuento->cantidad : old('cantidad') }}">
                @error('descuento')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>
            
            <a href="{{ route('descuentos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush