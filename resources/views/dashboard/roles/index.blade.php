@extends('layouts.dahboard')

@section('page-title','Roles')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Roles</li>
@endsection
@section('content')

<x-alert type="success" />
<x-alert type="info" />
<div class="mb-2">
    {{-- @can('roles.create') --}}
    <a class="btn btn-primary btn-sm mr-2" href=" {{route('dashboard.roles.create')}} ">Create</a>
    {{-- @endcan --}}

</div>
<form action="{{ route('dashboard.roles.index') }}" class="d-flex justify-content-between mb-4">
    <input type="text" placeholder="Name" name="name" class="form-control mx-2 " value="{{request('name')}}">
    {{-- <label for="">Status</label> --}}
    <select class="form-control mx-2" name="status" id="">
        <option value="">All</option>
        <option value="active" @if(request('status')=='active' ) selected @endif>Active</option>
        <option value="archived" @if(request('status')=='archived' ) selected @endif>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>

            <th>Created_at</th>
            <th></th>
        </tr>

    </thead>
    <tbody>

        @forelse ($roles as $role )
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>

            <td>{{$role->created_at}}</td>
            <td>

                <div class="btn-group">
                    <!-- <button type="button" class="btn btn-info"> -->
                    {{-- @can('roles.edit') --}}
                    <a class="btn btn-info" href="{{route('dashboard.roles.edit',$role->id)}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    {{-- @endcan --}}


                    <!-- </button> -->

                    <!-- create delete operation without js
                <form action="route('roles.destroy',$role->id)" method="POST">
                    {{-- @method('DELETE')
                    @csrf --}}
                    <button type="submit" class="btn btn-danger"> <i
                            class="fas fa-trash"></i></button>
                </form>
                -->
                    <!-- create delete operation with js -->
                    {{-- @can('roles.delete') --}}
                    <form action="{{route('dashboard.roles.destroy',$role->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-1"> <i class="fas fa-trash"></i></button>
                    </form>
                    {{-- @endcan --}}

                    {{-- deleteCategory('{{$role->id}}',this) --}}
                    {{-- <a onclick=""
                    class="btn btn-danger">
                    <i class="fas fa-trash"></i></a> --}}
                    <a href="{{route('dashboard.roles.show',$role->id)}}" class="btn btn-secondary btn-sm mr-1 ml-1">show</a>
                </div>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No Roles Defind</td>
        </tr>
        @endforelse



    </tbody>
</table>



{{$roles->withQueryString()->links()}}
{{-- {{$roles->withQueryString()->links('pagination.custom')}} if we have a custom pag we must pass to links function the view --}}


@endsection
