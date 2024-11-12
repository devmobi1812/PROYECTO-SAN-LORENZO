@extends('template')
@section('titulo', 'Crear Servicio')
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
                <label for="turno_id" class="form-label">Turno</label>
                
                    <select class="form-select" name="turno_id" id="">
                            <option value="">Seleccionar turno</option>  
                        @foreach ($turnos as $turno)
                            <option value="{{$turno->id}}" >{{$turno->nombre}}</option>
                        @endforeach
                    </select>
                    @error('turno_id')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
                
            </div>
            <div class="mb-3">
                <label for="producto_id" class="form-label">Producto</label>
                    <select class="form-select" name="producto_id" id="">
                            <option value="">Seleccionar producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{$producto->id}}" >{{$producto->nombre}}</option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <small class="text-danger"> {{ '*'.$message }}</small>
                    @enderror
                
            </div>
            
            <a href="{{ route('servicios') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
@push('js')

    
@endpush