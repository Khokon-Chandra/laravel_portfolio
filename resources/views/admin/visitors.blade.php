


@extends('admin.layout.app')
@section('title','visitors')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 p-5">
			<table id="dataTable" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
					<th class="th-sm">NO</th>
					<th class="th-sm">IP</th>
					<th class="th-sm">Date & Time</th>
					<th class="th-sm">Action</th>
					</tr>
				</thead>
				<tbody id="tbody">
					

				</tbody>
			</table>

		</div>
	</div>
</div>

<?php
printf("
<script>\n
const data = %s;\n
const attriute = ['sn','ip_address','created_at'];\n
const action = ['delete'];
const pageName = 'Visitor';
\n</script>
",$visitors);
?>

<script>
const pageName = "Service";
let action = ['delete','update'];
let attriute = ['image','title','description','created_at'];

</script>

@endsection







