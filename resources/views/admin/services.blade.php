

@extends('admin.layout.app')
@section('title','services')
@section('content')




<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
		<input type="text" class="form-control" placeholder="Title">
		</div>
		<div class="mb-3">
		<input type="text" class="form-control" placeholder="Description">
		</div>
		<div class="mb-3">
		<label class="btn d-block" for="file">Atach file</label>
        <input type="file" class="form-control d-none" id="file" >
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-sm btn-primary">Insert</button>
      </div>
    </div>
  </div>
</div>




<div class="container">
	<div class="row">
		<div class="col-md-12 p-5">

			<h2>Services</h2>
			<div class=" my-3 d-flex justify-content-between">
			<a data-toggle="modal" data-target="#insertModal" class="insert btn btn-sm btn-primary">Add New</a>
			<p><a href="{{url('/admin')}}" >Admin</a>\Services</p>
			</div>

			<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
					<th class="th-sm">Image</th>
					<th class="th-sm">Name</th>
					<th class="th-sm">Description</th>
					<th class="th-sm">Edit</th>
					<th class="th-sm">Delete</th>
					</tr>
				</thead>
				<tbody id="tbody"></tbody>
			</table>

		</div>
	</div>
</div>

<?php
printf("
<script>\n
const data = %s;\n
const attriute = ['image','title','description'];\n
const action = ['update','delete'];
const pageName = 'Service';
\n</script>
",$services);
?>
@endsection











