@extends('template')
@section('titulo', 'Crear abono')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Abono</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('alquileres') }}">Alquileres</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('abonos', $alquiler_id) }} ">Abonos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('abono-guardar') }}">
            @csrf
            <div class="mb-3">
                <label for="monto_pagado" class="form-label">Precio</label>
                <input type="number" name="monto_pagado" class="form-control @error('monto_pagado') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('monto_pagado') }}">
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
            <input type="hidden" name="alquiler_id" value="{{$alquiler_id}}">
        
            <a href="{{ route('abonos', $alquiler_id) }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
@push('js')
<script src="{{ asset('js/sweet-alert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush