@extends('admin.layout.auth')


@section('title','register')

@section('content')

<form class="registerForm" action="" method="POST">
  <h4 class="my-5 text-center">Register form</h4>
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input name="fname" type="text" id="form3Example1" class="form-control" />
        <label class="form-label" for="form3Example1">First name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input name="lname" type="text" id="form3Example2" class="form-control" />
        <label class="form-label" for="form3Example2">Last name</label>
      </div>
    </div>
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <input name="email" type="email" id="form3Example3" class="form-control" />
    <label class="form-label" for="form3Example3">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input name="password" type="password" id="form3Example4" class="form-control" />
    <label class="form-label" for="form3Example4">Password</label>
  </div>


  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Already have an account? <a href="{{url('/admin/login')}}">Login</a></p>
    <p>or sign up with:</p>
    <button type="button" class="btn btn-primary btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-primary btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-primary btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-primary btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>

@endsection

@section('script')
<script>


  const validation = (element)=>{
    let status = true;
    let count = 0;
    $.each(element,function(i,item){
      if(item.value == ""){
        $(item).addClass('is-invalid');
        status = false;
      }
      count ++;
      if(count >3){
        return false;
      }
    })
    return status;
  }


  const register = (data)=>{
    axios.post('http://127.0.0.1:8000/admin/register',data)
    .then(function(response){
      if(response.status === 200 && response.data.error === undefined){
        console.log(response.data);
        alert('Registration Successfully');
      }else{
        console.log(response.data);

      }
    })
    .catch(function(error){
      console.log(error);
    })
  }



  $(".registerForm").on('submit',function(event){
    event.preventDefault();
    if(validation(this)){
      let userInfo = $(this).serializeArray();
      let data = {};
      $.each(userInfo,function(i,field){
        data[field.name] = field.value;
      })
      register(data);
    }
  })
</script>
@endsection
