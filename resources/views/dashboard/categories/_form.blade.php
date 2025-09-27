    {{-- @if($errors->any())
    <div class="alert alert-danger">
        <h3>Errors Occured!</h3>
        @foreach ($errors->all() as $error )
            <li>$error </li>
        @endforeach

    </div>
    @endif --}}
    <div class="form-group">

        <x-form.input name="name" value="{{$category->name}}" type="text" label="Category Name"/>

    </div>
    <div class="form-group">
        <label for="">Parent</label>
        <select class="form-control @if($errors->has('parent_id')) is-invalid @endif" name="parent_id" type="text">
            <option value="">Primary Category</option>
            @foreach ($parents as $parent )
            <option value="{{$parent->id}}" @if(old('parent_id',$category->parent_id)==$parent->id) selected  @endif   >{{$parent->name}}</option>
            @endforeach

            </select>
              @error('parent_id')
            <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Description</label>
      <textarea  class="form-control @if($errors->has('description')) is-invalid @endif" name="description" >{{ old('description',$category->description) }} </textarea>
       @if($errors->has('description'))
        <div class="invalid-feedback">
            {{$errors->first('description')}}
        </div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Image</label>
        <input class="form-control @if($errors->has('image')) is-invalid @endif" name="image" type="file">
        @if($category->image)
        <img src="{{asset('storage/'.$category->image)}}" width="100px" accept="image/*" height="80px" alt="">
        @endif
        @if($errors->has('image'))
        <div class="invalid-feedback">
            {{$errors->first('image')}}
        </div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Status</label>
           <x-form.radio name="status" :checked="$category->status" :options="['active'=>'Active','archived'=>'Archived']"/>



    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"> {{$button_label ?? Save}} </button>
    </div>
