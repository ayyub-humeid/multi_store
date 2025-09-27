@extends('layouts.dahboard')

@section('page-title','Categories')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')

<x-alert type="success"/>
<x-alert type="info"/>
  <div class="mb-2" >
    <a class="btn btn-primary btn-sm mr-2" href=" {{route('categories.create')}} ">Create</a>
    <a class="btn btn-secondary btn-sm mr-2" href=" {{route('categories.trash')}} ">Trash</a>
</div>
<form action="{{ route('categories.index') }}" class="d-flex justify-content-between mb-4">
    <input type="text" placeholder="Name" name="name" class="form-control mx-2 " value="{{request('name')}}">
    {{-- <label for="">Status</label> --}}
    <select class="form-control mx-2" name="status" id="">
        <option value="">All</option>
        <option value="active"  @if(request('status') =='active') selected @endif >Active</option>
        <option value="archived"@if(request('status') =='archived') selected @endif >Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Products#</th>
            <th>Status</th>
            <th>Created_at</th>
            <th></th>
        </tr>

    </thead>
    <tbody>

          @forelse ($categories as $category )
        <tr>
            <td> <img src="{{asset('storage/'.$category->image)}}" style="border-radius: 5px" width = 55px; height="50px" alt=""> </td>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td> {{$category->parent_name??'Main Category'}} </td>
            <td> {{$category->products_count??'Main Category'}} </td>
            <td>{{$category->status}}</td>
            <td>{{$category->created_at}}</td>
             <td>

            <div class="btn-group">
                <!-- <button type="button" class="btn btn-info"> -->
                <a class="btn btn-info" href="{{route('categories.edit',$category->id)}}">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- </button> -->

                <!-- create delete operation without js
                <form action="route('categories.destroy',$category->id)" method="POST">
                    {{-- @method('DELETE')
                    @csrf --}}
                    <button type="submit" class="btn btn-danger"> <i
                            class="fas fa-trash"></i></button>
                </form>
                -->
                <!-- create delete operation with js -->
                    <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-1"> <i
                            class="fas fa-trash"></i></button>
                </form>
{{-- deleteCategory('{{$category->id}}',this) --}}
                {{-- <a onclick=""
                    class="btn btn-danger">
                    <i class="fas fa-trash"></i></a> --}}
                    <a href="{{route('categories.show',$category->id)}}" class="btn btn-secondary btn-sm mr-1 ml-1">show</a>
            </div>

        </td>
        </tr>
         @empty
        <tr>
           <td colspan="9">No Categoires Defind</td>
        </tr>
        @endforelse



    </tbody>
</table>



 {{$categories->withQueryString()->links()}}
 {{-- {{$categories->withQueryString()->links('pagination.custom')}} if we have a custom pag we must pass to links function the view  --}}


@endsection
