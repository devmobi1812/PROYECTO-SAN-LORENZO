@extends('template')
@section('titulo', 'Crear descuento')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Descuentos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('descuentos') }} ">Descuentos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('descuento-guardar') }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text"  name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text"  name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" aria-describedby="emailHelp">
                @error('cantidad')
                  <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            
            <a href="{{ route('descuentos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush