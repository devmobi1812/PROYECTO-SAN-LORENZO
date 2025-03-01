@extends('template')
@section('titulo', 'Crear metodo de pago')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Metodo de pago</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('metododepagos') }} ">Metodos De Pago</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('metododepago-guardar') }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" placeholder="Ingrese el nombre del metodo de pago" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>

            <a href="{{ route('metododepagos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush