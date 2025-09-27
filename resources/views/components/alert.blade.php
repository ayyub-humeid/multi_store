 @if(session()->has($type))
     <div class="alert alert-{{$type}}">
            <button type="button" style="color:white" data-bs-dismiss="alert" class="close">X</button>
           <li>{{ session($type) }} </li>
        </div>
    @endif

