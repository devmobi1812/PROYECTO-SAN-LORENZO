@extends('template')
@section('titulo', 'Crear abono')
@push('css')
    
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Abono</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Alquileres</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('abonos') }} ">Abonos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('abono-guardar') }}">
            @csrf
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('precio') }}">
                @error('contacto')
                    <small class="text-danger"> {{ '*'.$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="metodo_de_pagos_id" class="form-label">Metodo</label>
                
                    <select class="form-select" name="metodo_de_pagos_id" id="">
                            <option value="">Seleccionar metodo</option>  
                        @foreach ($metodos as $metodo)
                            <option value="{{$metodo->id}}" >{{$metodo->nombre}}</option>
                        @endforeach
                    </select>
                    @error('metodo_de_pagos_id')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
                
            </div>
        
            <a href="{{ route('abonos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
@push('js')
@endpush