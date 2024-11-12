<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descripción') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                value="{{ old('description', $maintenance?->description) }}" id="description" placeholder="Descripción">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="start_date" class="form-label">{{ __('Fecha de Inicio') }}</label>
            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', $maintenance?->start_date) }}" id="start_date" placeholder="Fecha de Inicio">
            {!! $errors->first('start_date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="end_date" class="form-label">{{ __('Fecha de Fin') }}</label>
            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                value="{{ old('end_date', $maintenance?->end_date) }}" id="end_date" placeholder="Fecha de Fin">
            {!! $errors->first('end_date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="observations" class="form-label">{{ __('Observaciones') }}</label>
            <input type="text" name="observations" class="form-control @error('observations') is-invalid @enderror"
                value="{{ old('observations', $maintenance?->observations) }}" id="observations"
                placeholder="Observaciones">
            {!! $errors->first('observations', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="computer_id" class="form-label">{{ __('Computadora') }}</label>
            <select name="computer_id" class="form-control @error('computer_id') is-invalid @enderror" id="computer_id"
                @if (Route::currentRouteName() == 'maintenances.edit') disabled @endif>
                <option value="">{{ __('Seleccionar una Computadora') }}</option>
                @foreach ($computers as $computer)
                    <option value="{{ $computer->id }}"
                        {{ old('computer_id', $maintenance?->computer_id) == $computer->id ? 'selected' : '' }}>
                        {{ $computer->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('computer_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="maintenance_type_id" class="form-label">{{ __('Tipo de Mantenimiento') }}</label>
            <select name="maintenance_type_id" class="form-control @error('maintenance_type_id') is-invalid @enderror"
                id="maintenance_type_id">
                <option value="">{{ __('Seleccionar un Tipo de Mantenimiento') }}</option>
                @foreach ($maintenanceTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ old('maintenance_type_id', $maintenance?->maintenance_type_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first(
                'maintenance_type_id',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>

        @if (Route::currentRouteName() == 'maintenances.edit')
            <div class="form-group mb-2 mb20">
                <label for="status" class="form-label">{{ __('Estado') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                    <option value="">{{ __('Seleccionar un Estado') }}</option>
                    <option value="pending" {{ old('status', $maintenance?->status) == 'pending' ? 'selected' : '' }}>
                        {{ __('Pendiente') }}
                    </option>
                    <option value="in_progress"
                        {{ old('status', $maintenance?->status) == 'in_progress' ? 'selected' : '' }}>
                        {{ __('En Progreso') }}
                    </option>
                    <option value="completed"
                        {{ old('status', $maintenance?->status) == 'completed' ? 'selected' : '' }}>
                        {{ __('Completado') }}
                    </option>
                </select>
                {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        @endif

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
