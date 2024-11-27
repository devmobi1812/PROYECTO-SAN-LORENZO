<div class="mb-3" style="visibility: hidden; height: 0;">
    <label for="servicios[{{$producto->id}}][id]" class="form-label">Selecciona las variantes de {{ $producto->nombre }}</label>
    <select class="form-select" name="servicios[{{$producto->id}}][id]">
        <option value="" selected>Selecciona aquí</option>
        @foreach($producto->servicios as $servicio)
            <option value="{{ $servicio->id }}" @selected($servicio->id == old("servicios.{$producto->id}.id"))>{{ $servicio->nombre }}</option>
        @endforeach
    </select>
    @error("servicios.{$producto->id}.id")
        <small class="text-danger">{{ '*'.$message }}</small>
    @enderror
</div>
