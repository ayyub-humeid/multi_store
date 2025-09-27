@extends('layouts.dahboard')

@section('page-title',$category->name)
@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories </li>
<li class="breadcrumb-item active"> {{$category->name}}  </li>
@endsection
@section('content')

<table class="table">
    <thead>
        <tr>
            <th></th>

            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created_at</th>
            {{-- <th></th> --}}
        </tr>

    </thead>
    <tbody>
        @php
           $products= $category->products()->with('store')->paginate(5)
        @endphp
          @forelse ($products as $product )
        <tr>
            <td> <img src="{{asset('storage/'.$product->image)}}" style="border-radius: 5px" width = 55px; height="50px" alt=""> </td>

            <td>{{$product->name}}</td>
            <td> {{$product->store->name}} </td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at}}</td>
        </tr>
         @empty
        <tr>
           <td colspan="5">No Products Defind</td>
        </tr>
        @endforelse
    </tbody>
</table>
 {{$products->withQueryString()->links()}}




@endsection
