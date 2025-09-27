@extends('layouts.dahboard')

@section('page-title','Categories')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories </li>
<li class="breadcrumb-item active">ُEdit Category </li>
@endsection
@section('content')

   <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('dahboard.categories._form',['button_label'=>'Update'])
</form>




@endsection
