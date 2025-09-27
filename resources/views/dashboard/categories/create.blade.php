@extends('layouts.dahboard')

@section('page-title','Categories')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories</li>
<ate class="breadcrumb-item active">Create</ate>
@endsection
@section('content')

   <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
  @include('dahboard.categories._form',['button_label'=>'Save'])
</form>




@endsection
