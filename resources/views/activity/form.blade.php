<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descripción') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                value="{{ old('description', $activity?->description) }}" id="description" placeholder="Descripción">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="start_date" class="form-label">{{ __('Fecha de Inicio') }}</label>
            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', $activity?->start_date) }}" id="start_date" placeholder="Fecha de Inicio">
            {!! $errors->first('start_date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="end_date" class="form-label">{{ __('Fecha de Fin') }}</label>
            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                value="{{ old('end_date', $activity?->end_date) }}" id="end_date" placeholder="Fecha de Fin">
            {!! $errors->first('end_date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="activity_type_id" class="form-label">{{ __('Tipo de Actividad') }}</label>
            <select name="activity_type_id" class="form-control @error('activity_type_id') is-invalid @enderror"
                id="activity_type_id">
                <option value="">{{ __('Seleccionar Tipo de Actividad') }}</option>
                @foreach ($activityTypes as $activity_type)
                    <option value="{{ $activity_type->id }}"
                        {{ old('activity_type_id', $activity?->activity_type_id) == $activity_type->id ? 'selected' : '' }}>
                        {{ $activity_type->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first(
                'activity_type_id',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="maintenance_id" class="form-label">{{ __('Mantenimiento') }}</label>
            <select name="maintenance_id" class="form-control @error('maintenance_id') is-invalid @enderror"
                id="maintenance_id">
                <option value="">{{ __('Seleccionar el Mantenimiento') }}</option>
                @foreach ($maintenances as $maintenance)
                    <option value="{{ $maintenance->id }}"
                        {{ old('maintenance_id', $activity?->maintenance_id) == $maintenance->id ? 'selected' : '' }}>
                        {{ $maintenance->code . ' - ' . $maintenance->computer->name . ' - ' . $maintenance->computer->client->user->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first(
                'activity_type_id',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
