@extends('template')
@section('titulo', 'Editar descuento')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Descuentos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('descuentos') }} ">Descuentos</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('descuento-actualizar', $descuento->id) }}">
            @csrf
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text"  name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('nombre') == "" ? $descuento->nombre : old('nombre') }}">
              @error('nombre')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text"  name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('cantidad') == "" ? $descuento->cantidad : old('cantidad') }}">
                @error('descuento')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            
            <a href="{{ route('descuentos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')
<script src="{{ asset('js/sweet-alert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush