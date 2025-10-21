    {{-- @if($errors->any())
    <div class="alert alert-danger">
        <h3>Errors Occured!</h3>
        @foreach ($errors->all() as $error )
            <li>$error </li>
        @endforeach

    </div>
    @endif --}}
    <div class="form-group">

        <x-form.input name="name" value="{{$role->name}}" type="text" label="Role Name" />

    </div>
    <fieldset>
        <legend>{{ __('Abilities') }}</legend>
        @foreach (config('abilities') as $ability => $value)
        <div class="row mb-2">
            <div class="col-md-6">
                {{ $value }}
            </div>
            <div class="col-md-2">
                <input type="radio" value="allow" name="abilities[{{ $ability }}]" id=""> {{ __('Allow') }}
            </div>
            <div class="col-md-2">
                <input type="radio" value="deny" name="abilities[{{ $ability }}]" id=""> {{ __('Deny') }}
            </div>
            <div class="col-md-2">
                <input type="radio" value="inherit" name="abilities[{{ $ability }}]" id=""> {{ __('Inherit') }}
            </div>
        </div>

        @endforeach
    </fieldset>

    <div class="form-group">
        <button type="submit" class="btn btn-primary"> {{$button_label ?? Save}} </button>
    </div>
