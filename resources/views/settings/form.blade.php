<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('name','Nombre') }}
            {{ Form::text('name', $role->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <div class="col-12">
                {{ Form::label('name','Lista de perimisos:') }}
                <div class="row">
                    <ul class="list-group list-group-flush">
                        @foreach ($permissions as $permission)
                            <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" {{$role->permissions->contains($permission->id) ? 'checked' : ''}} >
                                        <label class="form-check-label stretched-link" for="permission_{{ $permission->id }}">{{ $permission->description }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {!! $errors->first('permission', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
