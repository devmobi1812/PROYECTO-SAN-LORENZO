<div class="mb-3" id="quincho-select-container" style="visibility: hidden; height: 0;">
    <label for="quincho_variantes" class="form-label">Selecciona las variantes de {{ $producto->nombre }}</label>
    <select class="form-select" name="servicios[{{$producto->id}}][id]">
        <option value="" selected>Selecciona aquí</option>
        @foreach($producto->servicios as $servicio)
            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
        @endforeach
    </select>
    @error('quincho_id')
        <small class="text-danger">{{ '*'.$message }}</small>
    @enderror
</div>
