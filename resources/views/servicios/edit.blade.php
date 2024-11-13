@extends('template')
@section('titulo', 'Editar servicio')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Servicio</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('servicios') }} ">Servicios</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('servicio-actualizar', $servicio->id) }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" placeholder="Ingrese un nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre')=="" ? $servicio->nombre : old('nombre') }}">
                @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" placeholder="Ingrese el precio del servicio" name="precio" class="form-control @error('precio') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('precio')=="" ? $servicio->precio : old('precio') }}">
                @error('contacto')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>

            <div class="mb-3"> 
                <label for="turno_id" class="form-label">Turno</label> 
                <select class="form-select @error('turno_id') is-invalid @enderror" name="turno_id" id=""> 
                    <option value="">Seleccionar turno</option> 
                    @foreach ($turnos as $turno) 
                        <option value="{{ $turno->id }}" {{ (old('turno_id', $servicio->turno_id) == $turno->id) ? 'selected' : '' }}> {{ $turno->nombre }} </option>
                    @endforeach 
                </select> 
                @error('turno_id') 
                    <small class="text-danger"> {{ '*'.$message }}</small>
                @enderror 
            </div> 
            <div class="mb-3"> 
                <label for="producto_id" class="form-label">Producto</label> 
                    <select class="form-select @error('producto_id') is-invalid @enderror" name="producto_id" id=""> 
                        <option value="">Seleccionar producto</option> 
                        @foreach ($productos as $producto) 
                            <option value="{{ $producto->id }}" {{ (old('producto_id', $servicio->producto_id) == $producto->id) ? 'selected' : '' }}> {{ $producto->nombre }} </option>
                        @endforeach 
                    </select> 
                    @error('producto_id') 
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