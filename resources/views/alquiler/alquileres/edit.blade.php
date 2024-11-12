@extends('template')
@section('titulo', 'Editar alquiler')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar Alquiler</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('alquileres') }} ">Alquiler</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form method="POST" action="{{ route('alquiler-actualizar', $alquiler->id) }}">
            @csrf
           

            <div class="mb-3">
                <label for="nombre_id" class="form-label">Cliente</label>
                <select class="form-select" name="nombre_id" id="nombre_id">
                    <option value="">Seleccionar cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $alquiler->nombre_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
            </select>
                @error('nombre_id')
                    <small class="text-danger"> {{ '*' . $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Seleccionar fecha</label>
                <input class="form-control" type="date" id="fecha" name="fecha" value="{{ $alquiler->fecha }}">
            </div>

            <h4>¿Qué servicio deseas?</h4>
            <div class="mb-3">
                <!-- Quincho -->
                <label for="quincho" class="form-label">Quincho</label>
                <input type="checkbox" value="1" name="quincho" class="form-check-input" id="quincho-checkbox"
                    {{ $alquiler->quincho ? 'checked' : '' }}>
                <div class="mb-3" id="quincho-select-container"
                    style="{{ $alquiler->quincho ? '' : 'visibility: hidden; height: 0;' }}">
                    <label for="quincho_variantes" class="form-label">Selecciona las variantes de quincho</label>
                    <select class="form-select" name="quincho_id" id="quincho_variantes">
                        <option value="">Selecciona aquí</option>
                        @foreach ($quinchos as $quincho)
                            <option value="{{ $quincho->id }}"
                                {{ $alquiler->quincho_id == $quincho->id ? 'selected' : '' }}>
                                {{ $quincho->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Vajilla -->
                <label for="vajilla" class="form-label">Vajilla</label>
                <input type="checkbox" value="1" name="vajilla" class="form-check-input" id="vajilla-checkbox"
                    {{ $alquiler->vajilla ? 'checked' : '' }}>
                <div class="mb-3" id="vajilla-input-container"
                    style="{{ $alquiler->vajilla ? '' : 'visibility: hidden; height: 0;' }}">
                    <label for="servicio_cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="servicio_cantidad" id="servicio_cantidad"
                        value="{{ $alquiler->servicio_cantidad }}">
                </div>

                <!-- Pileta -->
                <label for="pileta" class="form-label">Pileta</label>
                <input type="checkbox" value="1" name="pileta" class="form-check-input" id="pileta-checkbox"
                    {{ $alquiler->pileta ? 'checked' : '' }}>
                <div class="mb-3 row" id="pileta-select-container"
                    style="{{ $alquiler->pileta ? '' : 'visibility: hidden; height: 0;' }}">
                    <div class="col-md-6">
                        <label for="desde" class="form-label">Desde</label>
                        <input type="time" name="desde" class="form-control" value="{{ $alquiler->desde }}">
                    </div>
                    <div class="col-md-6">
                        <label for="hasta" class="form-label">Hasta</label>
                        <input type="time" name="hasta" class="form-control" value="{{ $alquiler->hasta }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="deposito" class="form-label">Deposito</label>
                <select class="form-select" name="deposito" id="deposito">
                    <option value="">Seleccionar deposito</option>
                    @foreach ($depositos as $deposito)
                        <option value="{{ $deposito->monto }}"
                            {{ $alquiler->deposito == $deposito->monto ? 'selected' : '' }}>
                            {{ $deposito->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="descuento_id" class="form-label">Descuento</label>
                <select class="form-select" name="descuento_id" id="descuento_id">
                    <option value="">Seleccionar descuento</option>
                    @foreach ($descuentos as $descuento)
                        <option value="{{ $descuento->id }}"
                            {{ $alquiler->descuento_id == $descuento->id ? 'selected' : '' }}>
                            {{ $descuento->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Seña -->
            <label for="quincho" class="form-label">Abonar seña</label>
            <input type="checkbox" value="1" name="seña" class="form-check-input @error('seña') is-invalid @enderror" id="seña-checkbox" aria-describedby="emailHelp" @if(old('seña') == 'seña') checked @endif>
            <div class="mb-3" id="seña-select-container" style="visibility: hidden; height: 0;">
                <label for="seña" class="form-label">Seleccionar metodo</label>
                <select class="form-select" name="metodo_de_pagos_id" id="">
                        <option value="">Seleccionar aqui</option>  
                    @foreach ($metodos as $metodo)
                        <option value="{{$metodo->id}}" >{{$metodo->nombre}}</option>
                    @endforeach
                </select>
                @error('metodo_de_pagos_id')
                    <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>

            <a href="{{ route('alquileres') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/alquileres.js') }}"></script>
    
    
@endpush
