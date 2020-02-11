@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">Edit Category</a> </div>
    <h1>Category</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-category/'.$category->id) }}" name="edit_category" id="edit_category" novalidate="novalidate">
            	@csrf
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name" value="{{ $category->name }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                  <select name="parent_id">
                    <option value="0">Main Category</option>
                    @foreach($levels as $level)
                      <option value="{{ $level->id }}" @if($category->parent_id == $level->id) selected @endif >{{ $level->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                	<textarea name="description" id="description">{{ $category->description }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{ $category->url }}">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Category" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  
$(document).ready(function(){
  
  // Add Category Validation
    $("#edit_category").validate({
    rules:{
      category_name:{
        required:true
      },
      description:{
        required:true
      },
      url:{
        required:true
      }
    },
    errorClass: "help-inline",
    errorElement: "span",
    highlight:function(element, errorClass, validClass) {
      $(element).parents('.control-group').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).parents('.control-group').removeClass('error');
      $(element).parents('.control-group').addClass('success');
    }
  });

});

</script> 
@endpush