

@extends('admin.layout.app')
@section('title','services')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody>
  
	<tr>
      <th class="th-sm"><img class="table-img" src="images/Knowledge.svg"></th>
	  <th class="th-sm">আইটি কোর্স</th>
	  <th class="th-sm">মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট</th>
	  <th class="th-sm"><a href="" ><i class="fas fa-edit"></i></a></th>
	  <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
    </tr>	
	<tr>
      <th class="th-sm"><img class="table-img" src="images/Knowledge.svg"></th>
	  <th class="th-sm">আইটি কোর্স</th>
	  <th class="th-sm">মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট</th>
	  <th class="th-sm"><a href="" ><i class="fas fa-edit"></i></a></th>
	  <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
    </tr>
	<tr>
      <th class="th-sm"><img class="table-img" src="images/Knowledge.svg"></th>
	  <th class="th-sm">আইটি কোর্স</th>
	  <th class="th-sm">মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট</th>
	  <th class="th-sm"><a href="" ><i class="fas fa-edit"></i></a></th>
	  <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
    </tr>
	
	
	
  </tbody>
</table>







<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#exampleModal"
>
  Launch demo modal
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="exampleModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button
          type="button"
          class="btn-close"
          data-mdb-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">...</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>










</div>
</div>
</div>

@endsection











