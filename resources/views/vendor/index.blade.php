@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('vendor.create') }}"> Create New Vendor</a>
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
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($vendors as $vendor)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $vendor->name }}</td>
            <td>{{ $vendor->detail }}</td>
            <td>
                <form action="{{ route('vendor.destroy',$vendor->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('vendor.show',$vendor->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('vendor.edit',$vendor->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
    {!! $vendors->links() !!}
      
@endsection