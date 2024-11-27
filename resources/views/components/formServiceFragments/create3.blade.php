<div class="mb-3" id="vajilla-input-container" style="visibility: hidden; height: 0;">
    <input type="hidden" name="servicios[{{$producto->id}}][id]" value="{{$producto->servicios[0]->id}}">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" class="form-control" name="servicios[{{$producto->id}}][cantidad]" placeholder="Cantidad de vajilla" value="{{ old('servicios.'.$producto->id.'.cantidad') }}">
    @error('servicio_cantidad')
        <small class="text-danger">{{ '*'.$message }}</small>
    @enderror
</div>