@extends('template')
@section('titulo', 'Panel')
@push('css')

@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Clientes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('clientes') }} ">Clientes</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('cliente-guardar') }}">
            @csrf
            <div class="mb-3">
              <label for="dni" class="form-label">DNI</label>
              <input type="number" placeholder="DNI sin puntos..." name="dni" class="form-control @error('dni') is-invalid @enderror" aria-describedby="emailHelp">
              @error('dni')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp">
                @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto</label>
                <input type="text" name="contacto" class="form-control @error('contacto') is-invalid @enderror" aria-describedby="emailHelp">
                @error('contacto')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="domicilio" class="form-label">Domicilio</label>
                <input type="text" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" aria-describedby="emailHelp">
                @error('domicilio')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="socio" class="form-label">
                    Es socio
                    <input type="checkbox" value="1" name="socio" class="checkbox-control @error('socio') is-invalid @enderror" aria-describedby="emailHelp">
                </label>
                @error('socio')
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