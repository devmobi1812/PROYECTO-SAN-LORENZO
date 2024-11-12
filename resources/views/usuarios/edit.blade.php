@extends('template')
@section('titulo', 'Editar descuento')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Usuarios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('usuarios') }} ">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('usuario-actualizar', $usuario->id) }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('name') == "" ? $usuario->name : old('name') }}">
              @error('name')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email"  name="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('email') == "" ? $usuario->email : old('email') }}">
                @error('email')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password"  name="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="emailHelp" >
                @error('password')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>

            <div class="mb-3">
                <label for="password2" class="form-label">Repita su contraseña</label>
                <input type="password"  name="password2" class="form-control @error('password2') is-invalid @enderror" aria-describedby="emailHelp" >
                @error('password2')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>
            
            <a href="{{ route('usuarios') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
    </div>
@endsection
@push('js')
  <script src="{{ asset('js/sweet-alert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush