@extends('template')
@section('titulo', 'Editar abono')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Abono</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('alquileres') }}">Alquileres</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('abonos',$abono->id)}}">Abonos</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('abono-actualizar', $abono->id) }}">
            @csrf
            <div class="mb-3">
                <label for="monto_pagado" class="form-label">Precio</label>
                <input type="number" placeholder="Monto abonado" name="monto_pagado" class="form-control @error('monto_pagado') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('monto_pagado')=="" ? $abono->monto_pagado : old('monto_pagado') }}">
                @error('monto_pagado')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="metodo_de_pagos_id" class="form-label">Metodo</label>
                    <select class="form-select" name="metodo_de_pagos_id">
                            <option value="">Seleccionar metodo</option>  
                        @foreach ($metodos as $metodo)
                            <option value="{{ $metodo->id }}" {{ (old('metodo_de_pagos_id', $abono->metodo_de_pagos_id) == $metodo->id) ? 'selected' : '' }}> {{ $metodo->nombre }} </option>
                        @endforeach
                    </select>
                    @error('metodo_de_pagos_id')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
            </div>

            <a href="{{ route('alquiler-ver',$abono->alquiler->id)}}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')

    
@endpush