@extends('template')
@section('titulo', 'Panel')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Servicios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('servicios') }} ">Servicios</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('servicio-guardar') }}">
            @csrf
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre') }}">
                @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Precio</label>
                <input type="text" name="contacto" class="form-control @error('contacto') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('contacto') }}">
                @error('contacto')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="domicilio" class="form-label">Turno</label>
                <input type="text" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('domicilio') }}">
                @error('domicilio')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <a href="{{ route('clientes') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')
@endpush