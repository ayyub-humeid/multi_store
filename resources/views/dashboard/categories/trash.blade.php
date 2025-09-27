@extends('layouts.dahboard')

@section('page-title','Trashed Categories')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Trashed</li>
@endsection
@section('content')

<x-alert type="success"/>
<x-alert type="info"/>
<div >
    <a class="btn btn-primary" href=" {{route('categories.index')}} ">Back</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Deleted_At</th>
            <th></th>
        </tr>

    </thead>
    <tbody>

          @forelse ($categories as $category )
        <tr>
            <td> <img src="{{asset('storage/'.$category->image)}}" style="border-radius: 5px" width = 55px; height="50px" alt=""> </td>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->parent_name ?? 'Primary Category'}}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->created_at}}</td>
            <td>{{$category->deleted_at}}</td>
             <td>

            <div class="btn-group">

                    <form action="{{route('categories.restore',$category->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-outline-warning btn-sm mr-1">
                            Restore</button>
                </form>
{{-- deleteCategory('{{$category->id}}',this) --}}
                {{-- <a onclick=""
                    class="btn btn-danger">
                    <i class="fas fa-trash"></i></a> --}}
                     <form action="{{route('categories.force_delete',$category->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm mr-1">
                        Force Delete</button>
                </form>
            </div>

        </td>
        </tr>
         @empty
        <tr>
           <td colspan="7">No Categoires Defind</td>
        </tr>
        @endforelse



    </tbody>
</table>



 {{$categories->withQueryString()->links()}}
 {{-- {{$categories->withQueryString()->links('pagination.custom')}} if we have a custom pag we must pass to links function the view  --}}


@endsection
