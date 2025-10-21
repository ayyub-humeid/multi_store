@extends('layouts.dahboard')

@section('page-title','Roles')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Roles </li>
<li class="breadcrumb-item active">ُEdit Category </li>
@endsection
@section('content')

<form action="{{route('dashboard.roles.update',$role->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('dashboard.roles._form',['button_label'=>'Update'])
</form>




@endsection
