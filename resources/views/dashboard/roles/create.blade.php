@extends('layouts.dahboard')

@section('page-title','Roles')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Roles</li>
<ate class="breadcrumb-item active">Create</ate>
@endsection
@section('content')

<form action="{{route('dashboard.roles.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('dashboard.roles._form',['button_label'=>'Save'])
</form>




@endsection
