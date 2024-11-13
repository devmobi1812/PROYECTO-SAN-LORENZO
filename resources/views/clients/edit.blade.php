@extends('template')
@section('titulo', 'Editar cliente')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Cliente</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('clientes') }} ">Clientes</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('cliente-actualizar', $cliente->id) }}">
            @csrf
            <div class="mb-3">
              <label for="dni" class="form-label">DNI</label>
              <input type="number" placeholder="Ingrese DNI sin puntos" name="dni" class="form-control @error('dni') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('dni') == "" ? $cliente->dni : old('dni') }}">
              @error('dni')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" placeholder="Ingrese el nombre del cliente" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre')=="" ? $cliente->nombre : old('nombre') }}">
                @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto</label>
                <input type="text" placeholder="Ingrese información de contacto" name="contacto" class="form-control @error('contacto') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('contacto')=="" ? $cliente->contacto : old('contacto') }}">
                @error('contacto')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="domicilio" class="form-label">Domicilio</label>
                <input type="text" placeholder="Ingrese el domicilio del cliente" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('domicilio')=="" ? $cliente->domicilio : old('domicilio') }}">
                @error('domicilio')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="socio" class="form-label">
                    Es socio
                    <input type="hidden" name="socio" value="0"> <!-- Este campo oculto asegura que el valor 0 se envíe si el checkbox no está marcado --> 
                    <input type="checkbox" value="1" name="socio" class="form-check-input @error('socio') is-invalid @enderror" aria-describedby="emailHelp" 
                    @if(old('socio') == '')
                        @if($cliente->socio)
                            checked
                        @endif
                    @else
                        @if(old('socio'))
                            checked
                        @endif
                    @endif
                    >
                </label>
                @error('socio')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror   
            </div>
            <a href="{{ route('clientes') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush