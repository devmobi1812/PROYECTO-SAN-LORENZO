@extends('template')
@section('titulo', 'Panel')
@push('css')
    
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Servicios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('servicios') }} ">Servicios</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('servicio-guardar') }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre') }}">
                @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('precio') }}">
                @error('contacto')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="turno" class="form-label">Turno</label>
                @foreach ($turnos as $turno)
                    <select class="form-select" name="id_turno" id="">
                        <option value="{{$turno->id}}" >{{$turno->nombre}}</option>
                    </select>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="producto" class="form-label">Producto</label>
                @foreach ($productos as $producto)
                    <select class="form-select" name="id_producto" id="">
                        <option value="{{$producto->id}}" >{{$producto->nombre}}</option>
                    </select>
                @endforeach
            </div>
            <a href="{{ route('servicios') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')
@endpush