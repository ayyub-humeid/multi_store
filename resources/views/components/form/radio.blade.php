@props(['name','options','checked'=>false])

@foreach ($options as $value => $text )
   <div class="form-check">
        <input type="radio" class="form-check-input" name="{{$name}}"  @checked(old($name,$checked)==$value) value="{{$value}}"
        {{$attributes->class([
            'form-check-input',
            'is-invalid'=>$errors->has($name)
        ])}}
        >
        <label for="" class="form-check-label">
        {{$text}}
        </label>
        </div>
@endforeach
