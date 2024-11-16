<div class="mb-3" id="pileta-select-container" style="visibility: hidden; height: 0;">
    <div class="mb-3 row">
        <input type="hidden" name="servicios[{{$producto->id}}][id]" value="{{$producto->servicios[0]->id}}">
        <div class="col-md-6">
            <label for="desde" class="form-label">Desde</label>
            <input type="time" name="servicios[{{$producto->id}}][desde]" class="form-control" aria-describedby="emailHelp" value="{{ old('servicios['.$producto->id.'][desde]') }}">
            @error('desde')
                <small class="text-danger">{{ '*'.$message }}</small>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="hasta" class="form-label">Hasta</label>
            <input type="time" name="servicios[{{$producto->id}}][hasta]" class="form-control" aria-describedby="emailHelp" value="{{ old('servicios['.$producto->id.'][hasta]') }}">
            @error('hasta')
                <small class="text-danger">{{ '*'.$message }}</small>
            @enderror
        </div>
    </div>
</div>