@extends('layouts.adminLayout.admin_design')

@push('css')
<link rel="stylesheet" href="{{ asset('css/backend_css/select2.css') }}" />
@endpush

@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">View Products</a> </div>
    <h1>Products</h1>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif          
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Products ID</th>
                  <th>Category Name</th>
                  <th>Products Name</th>
                  <th>Products Code</th>
                  <th>Products Color</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
                <tr class="gradeX">
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>{{ $product->price }}</td>
                  <td>
                    @if(!empty($product->image))
                    <img width="50" src="{{ asset('/images/backend_images/products/small/'.$product->image) }}">
                    @endif
                  </td>
                  <td class="center"><a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini">Edit</a> <a id="delChat" href="{{ url('/admin/delete-product/'.$product->id) }}" class="btn btn-danger btn-mini">Delete</a></td>
                </tr>

                <div id="myModal{{ $product->id }}" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>{{ $product->product_name }} Full Details</h3>
                  </div>
                  <div class="modal-body">
                    <p>Products ID: {{ $product->id }}</p>
                    <p>Category Name: {{ $product->category_name }}</p>
                    <p>Products Name: {{ $product->product_name }}</p>
                    <p>Products Code: {{ $product->product_code }}</p>
                    <p>Products Color: {{ $product->product_color }}</p>
                    <p>Price: {{ $product->price }}</p>
                    <p>Image</p>
                  </div>
                </div>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

@push('scripts')
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.popover.js') }}"></script> 
<script type="text/javascript">
$(document).ready(function(){

  $('#delChat').click(function(){
    if (confirm('Are you sure you want to delete this Category?')) {
      return true;
    }
    return false;
  });
  
});
</script>
@endpush