@extends('template')
@section('titulo', 'Crear deposito')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Deposito</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('depositos') }} ">Depositos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('deposito-guardar') }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" placeholder="Ingrese un nombre"  name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="monto" class="form-label">Monto</label>
                <input type="text" placeholder="Ingrese solo numeros" name="monto" class="form-control @error('monto') is-invalid @enderror" aria-describedby="emailHelp">
                @error('monto')
                  <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            
            <a href="{{ route('depositos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush