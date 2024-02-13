@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Category</th>
            <th>Vendor</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $data)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $data->cat_id }}</td>
            <td>{{ $data->vendor_id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->description }}</td>
            <td>{{ $data->price }}</td>
            
            
            <td>
                <form action="{{ route('products.destroy',$data->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('products.show',$data->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$data->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
    {!! $products->links() !!}
      
@endsection