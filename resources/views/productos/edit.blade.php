@extends('template')
@section('titulo', 'Editar producto')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('productos') }} ">Productos</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('producto-actualizar', $producto->id) }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre </label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre')=="" ? $producto->nombre : old('nombre') }}">
                @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
           
            <a href="{{ route('productos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush