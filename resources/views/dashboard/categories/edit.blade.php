@extends('layouts.dahboard')

@section('page-title','Categories')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories </li>
<li class="breadcrumb-item active">ُEdit Category </li>
@endsection
@section('content')

<form action="{{route('dashboard.categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('dashboard.categories._form',['button_label'=>'Update'])
</form>




@endsection
