@extends('template')
@section('titulo', 'Crear Recibo')
@push('css')
    
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Recibo</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Alquileres</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('recibos') }} ">Recibos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{route('recibo-guardar')}}">
            @csrf
            <div class="mb-3">
                <label for="servicio_nombre" class="form-label">Servicio</label>
                <input type="text" name="servicio_nombre" class="form-control @error('servicio_nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('servicio_nombre') }}">
                @error('servicio_nombre')
                    <small class="text-danger"> {{ '*'.$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="servicio_precio" class="form-label">Precio</label>
                <input type="number" name="servicio_precio" class="form-control @error('servicio_precio') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('servicio_precio') }}">
                @error('servicio_precio')
                    <small class="text-danger"> {{ '*'.$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="servicio_cantidad" class="form-label">Cantidad</label>
                <input type="number" name="servicio_cantidad" class="form-control @error('servicio_cantidad') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('servicio_cantidad') }}">
                @error('servicio_cantidad')
                    <small class="text-danger"> {{ '*'.$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="servicio_deposito" class="form-label">Deposito</label>
                <input type="number" name="servicio_deposito" class="form-control @error('servicio_deposito') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('servicio_deposito') }}">
                @error('servicio_deposito')
                    <small class="text-danger"> {{ '*'.$message}}</small>
                @enderror
            </div>
           
        
            <a href="{{ route('recibos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
@push('js')
@endpush