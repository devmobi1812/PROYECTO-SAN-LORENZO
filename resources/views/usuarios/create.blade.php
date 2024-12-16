@extends('template')
@section('titulo', 'Editar usuarios')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('usuarios') }} ">Usuarios</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
        <form method="POST" action="{{ route('usuario-guardar') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input type="text" placeholder="Ingrese el nombre del nuevo usuario" name="name" class="form-control @error('name') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('name') }}">
              @error('name')
                <small class="text-danger"> {{ '*'.$message}}</small>
            @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" placeholder="Ingrese su email" name="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('email') }}">
                @error('email')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" placeholder="Ingrese su contraseña" name="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="emailHelp" >
                @error('password')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>

            <div class="mb-3">
                <label for="password2" class="form-label">Repita su contraseña</label>
                <input type="password" placeholder="Vuelva a ingresar su contraseña" name="password2" class="form-control @error('password2') is-invalid @enderror" aria-describedby="emailHelp" >
                @error('password2')
                  <small class="text-danger"> {{ '*'.$message}}</small>
              @enderror
            </div>
            
            <a href="{{ route('usuarios') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
    </div>
@endsection
@push('js')
  
    
@endpush