<div class="mb-3" style="visibility: hidden; height: 0;">
    <div class="mb-3 row">
        <input type="hidden" name="servicios[{{$producto->id}}][id]" value="{{$producto->servicios[0]->id}}">
        <div class="col-md-6">
            <label for="servicios[{{$producto->id}}][desde]" class="form-label">Desde</label>
            <input type="time" name="servicios[{{$producto->id}}][desde]" class="form-control" aria-describedby="emailHelp" value="{{ old('servicios.'.$producto->id.'.desde') }}">
            @error("servicios.{$producto->id}.desde")
                <small class="text-danger">{{ '*'.$message }}</small>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="servicios[{{$producto->id}}][hasta]" class="form-label">Hasta</label>
            <input type="time" name="servicios[{{$producto->id}}][hasta]" class="form-control" aria-describedby="emailHelp" value="{{ old('servicios.'.$producto->id.'.hasta') }}">
            @error("servicios.{$producto->id}.hasta")
                <small class="text-danger">{{ '*'.$message }}</small>
            @enderror
        </div>
    </div>
</div>