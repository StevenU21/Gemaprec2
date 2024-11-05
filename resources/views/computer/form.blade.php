<div class="row g-3 p-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $computer?->name) }}" id="name" placeholder="Nombre">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="description" class="form-label">{{ __('Descripción') }}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                id="description" placeholder="Descripción">{{ old('description', $computer?->description) }}</textarea>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="serial_number" class="form-label">{{ __('Número Serial') }}</label>
            <input type="text" name="serial_number" class="form-control @error('serial_number') is-invalid @enderror"
                value="{{ old('serial_number', $computer?->serial_number) }}" id="serial_number" placeholder="Número Serial">
            {!! $errors->first('serial_number', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="mac_address" class="form-label">{{ __('Dirección MAC') }}</label>
            <input type="text" name="mac_address" class="form-control @error('mac_address') is-invalid @enderror"
                value="{{ old('mac_address', $computer?->mac_address) }}" id="mac_address" placeholder="Dirección MAC">
            {!! $errors->first('mac_address', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="adquisition_date" class="form-label">{{ __('Fecha de Adquisición') }}</label>
            <input type="date" name="adquisition_date"
                class="form-control @error('adquisition_date') is-invalid @enderror"
                value="{{ old('adquisition_date', $computer?->adquisition_date) }}" id="adquisition_date">
            {!! $errors->first('adquisition_date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="status" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror"
                value="{{ old('status', $computer?->status) }}" id="status" placeholder="Estado">
            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="brand_id" class="form-label">{{ __('Marca') }}</label>
            <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror" id="brand_id">
                <option value="">{{ __('Seleccione una Marca') }}</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $computer?->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('brand_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group">
            <label for="client_id" class="form-label">{{ __('Client') }}</label>
            <select name="client_id" class="form-control @error('client_id') is-invalid @enderror" id="client_id">
                <option value="">{{ __('Seleccione un Cliente') }}</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $computer?->client_id) == $client->id ? 'selected' : '' }}>{{ $client->user->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('client_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="pc_model_id" class="form-label">{{ __('Modelo') }}</label>
            <select name="pc_model_id" class="form-control @error('pc_model_id') is-invalid @enderror" id="pc_model_id">
                <option value="">{{ __('Seleccione un Modelo') }}</option>
                @foreach($pcModels as $pcModel)
                    <option value="{{ $pcModel->id }}" {{ old('pc_model_id', $computer?->pc_model_id) == $pcModel->id ? 'selected' : '' }}>{{ $pcModel->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('pc_model_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="pc_type_id" class="form-label">{{ __('Tipo de PC') }}</label>
            <select name="pc_type_id" class="form-control @error('pc_type_id') is-invalid @enderror" id="pc_type_id">
                <option value="">{{ __('Seleccione un Tipo de PC') }}</option>
                @foreach($pcTypes as $pcType)
                    <option value="{{ $pcType->id }}" {{ old('pc_type_id', $computer?->pc_type_id) == $pcType->id ? 'selected' : '' }}>{{ $pcType->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('pc_type_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="ubications_id" class="form-label">{{ __('Ubicación') }}</label>
            <select name="ubications_id" class="form-control @error('ubications_id') is-invalid @enderror" id="ubications_id">
                <option value="">{{ __('Seleccione una Ubicación') }}</option>
                @foreach($ubications as $ubication)
                    <option value="{{ $ubication->id }}" {{ old('ubications_id', $computer?->ubications_id) == $ubication->id ? 'selected' : '' }}>{{ $ubication->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('ubications_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
