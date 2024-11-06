@extends('template')
@section('titulo', 'Editar abono')
@push('css')

@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Alquileres</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('abonos')}}">Abonos</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('servicio-actualizar', $servicio->id) }}">
            @csrf
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" name="precio" class="form-control @error('precio') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('precio')=="" ? $servicio->precio : old('precio') }}">
                @error('contacto')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="metodo_de_pagos_id" class="form-label">Metodo</label>
                
                    <select class="form-select" name="metodo_de_pagos_id" id="">
                            <option value="">Seleccionar metodo</option>  
                        @foreach ($metodos as $metodo)
                            <option value="{{ $metodo->id }}" {{ (old('metodo_de_pagos_id', $selectedMetodoId) == $metodo->id) ? 'selected' : '' }}> {{ $metodo->nombre }} </option>
                        @endforeach
                    </select>
                    @error('metodo_de_pagos_id')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
                
            </div>

            <a href="{{ route('servicios') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')
@endpush