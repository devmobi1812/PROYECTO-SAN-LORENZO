@extends('template')
@section('titulo', 'Editar recibo')
@push('css')
@endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Recibo</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('recibo-guardar', $alquiler->id) }}">Alquileres</a></li>
            <li class="breadcrumb-item active">Editar recibo</li>
        </ol>
        <form method="POST" action="{{route('recibo-guardar', $recibo->id)}}">
            @csrf
            <div class="mb-36">
                    @foreach($productos as $index => $producto)
                        <label class="form-label">{{ $producto->nombre }}</label>
                        <input type="checkbox" name="servicios[{{$producto->id}}][selected]"  value="1" class="form-check-input checkbox-servicio" aria-describedby="emailHelp">
                            @include('components.formServiceFragments.create'.$producto->tipoProducto->id, [
                                "producto" => $producto
                            ])
                    @endforeach
            </div>
           
        
            <a href="{{ route('alquiler-ver', $alquiler->id) }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/alquileres.js') }}"></script>
@endpush
