@extends('template')
@section('titulo', 'Editar deposito')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Deposito</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('depositos') }} ">Descuentos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('deposito-actualizar', $deposito->id) }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text"  name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre') == "" ? $deposito->nombre : old('nombre') }}">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            <div class="mb-3">
                <label for="monto" class="form-label">Cantidad</label>
                <input type="text"  name="monto" class="form-control @error('monto') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('monto') == "" ? $deposito->monto : old('monto') }}">
                @error('estado')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>
            
            <a href="{{ route('depositos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush