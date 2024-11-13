@extends('template')
@section('titulo', 'Crear turno')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Turno</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('turnos') }} ">Turnos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('turno-guardar') }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text"  name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre') }}">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="desde" class="form-label">Desde</label>
                <input type="time" name="desde" class="form-control @error('desde') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('desde') }}">
                @error('desde')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="hasta" class="form-label">Hasta</label>
                <input type="time" name="hasta" class="form-control @error('hasta') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('hasta') }}">
                @error('hasta')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            
            <a href="{{ route('turnos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush