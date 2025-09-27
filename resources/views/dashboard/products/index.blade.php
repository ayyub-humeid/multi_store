@extends('layouts.dahboard')

@section('page-title','products')
@section('breadcrum')
@parent
<li class="breadcrumb-item active">products</li>
@endsection
@section('content')

<x-alert type="success"/>
<x-alert type="info"/>
  <div class="mb-2" >
    <a class="btn btn-primary btn-sm mr-2" href=" {{route('products.create')}} ">Create</a>
    {{-- <a class="btn btn-secondary btn-sm mr-2" href=" {{route('products.trash')}} ">Trash</a> --}}
</div>
<form action="{{ route('products.index') }}" class="d-flex justify-content-between mb-4">
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
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created_at</th>
            <th></th>
        </tr>

    </thead>
    <tbody>

          @forelse ($products as $product )
        <tr>
            <td> <img src="{{asset('storage/'.$product->image)}}" style="border-radius: 5px" width = 55px; height="50px" alt=""> </td>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td> {{$product->category->name}} </td>
            <td> {{$product->store->name}} </td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at}}</td>
             <td>

            <div class="btn-group">
                <!-- <button type="button" class="btn btn-info"> -->
                <a class="btn btn-info" href="{{route('products.edit',$product->id)}}">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- </button> -->

                <!-- create delete operation without js
                <form action="route('products.destroy',$product->id)" method="POST">
                    {{-- @method('DELETE')
                    @csrf --}}
                    <button type="submit" class="btn btn-danger"> <i
                            class="fas fa-trash"></i></button>
                </form>
                -->
                <!-- create delete operation with js -->
                    <form action="{{route('products.destroy',$product->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger"> <i
                            class="fas fa-trash"></i></button>
                </form>
{{-- deleteproduct('{{$product->id}}',this) --}}
                {{-- <a onclick=""
                    class="btn btn-danger">
                    <i class="fas fa-trash"></i></a> --}}
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



 {{$products->withQueryString()->links()}}
 {{-- {{$products->withQueryString()->links('pagination.custom')}} if we have a custom pag we must pass to links function the view  --}}


@endsection
