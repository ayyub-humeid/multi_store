@extends('layouts.dahboard')

@section('page-title','Categories')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories</li>
<ate class="breadcrumb-item active">Create</ate>
@endsection
@section('content')

<form action="{{route('dashboard.categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('dashboard.categories._form',['button_label'=>'Save'])
</form>




@endsection
