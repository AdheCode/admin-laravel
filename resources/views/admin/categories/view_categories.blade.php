@extends('layouts.adminLayout.admin_design')

@push('css')
<link rel="stylesheet" href="{{ asset('css/backend_css/select2.css') }}" />
@endpush

@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">View Categories</a> </div>
    <h1>Categories</h1>
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
            <h5>View Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Categories ID</th>
                  <th>Categories Name</th>
                  <th>Categories URL</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($categories as $category)
                <tr class="gradeX">
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->url }}</td>
                  <td class="center"><a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-mini">Edit</a> <a id="delChat" href="{{ url('/admin/delete-category/'.$category->id) }}" class="btn btn-danger btn-mini">Delete</a></td>
                </tr>
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