@props(['type'=>'text','label'=>'','name','value'=>''])
<label for="">{{$label}}</label>
<input name="{{$name}}"  type="{{$type}}" value="{{old($name,$value)}}"
 @class([
            'form-control',
            'is-invalid'=>$errors->has($name)
        ])
      >
 @error('name')
            <div class="invalid-feedback">
           <li>{{ $message }}</li>
        </div>
@enderror
