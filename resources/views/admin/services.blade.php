

@extends('admin.layout.app')
@section('title','services')
@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-12 p-5">

			<h2>Services</h2>
			<div class=" my-3 d-flex justify-content-between">
			<a class="btn btn-sm btn-primary">Add New</a>
			<p><a href="{{url('/admin')}}" >Admin</a>\Services</p>
			</div>

			<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
					<th class="th-sm">Image</th>
					<th class="th-sm">Title</th>
					<th class="th-sm">Description</th>
					<th class="th-sm">Date</th>
					<th class="th-sm">Action</th>
					</tr>
				</thead>
				<tbody id="tbody"></tbody>
			</table>

		</div>
	</div>
</div>
<script>
const pageName = "Service";
let action = ['delete','update'];
let attriute = ['image','title','description','created_at'];
</script>
@endsection











