@extends("admin.layout.auth")

@section('title','login')

@section('content')

<form class="loginForm" action="" method="POST">
@csrf
    <h4 class="my-5 text-center">Login form</h4>
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input name="email" type="email" id="form2Example1" class="form-control" />
    <label class="form-label" for="form2Example1">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input name="password" type="password" id="form2Example2" class="form-control" />
    <label class="form-label" for="form2Example2">Password</label>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          value=""
          id="form2Example3"
          checked
        />
        <label class="form-check-label" for="form2Example3"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="{{url('/admin/register')}}">Register</a></p>
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


$(".loginForm").on('submit',function(event){
  event.preventDefault();
  let loginInfo = $(this).serializeArray();
  let status = true;

  if(this[1].value == ""){
    $(this[1]).addClass('is-invalid');
    status = false;
  }



  if(this[2].value == ""){
    $(this[2]).addClass('is-invalid');
    status = false;
  }


  function invalid(msg){
    return `<div  class="invalid-feedback mb-5">${msg}</div>`;
  }


  if(status){
    axios.post('http://127.0.0.1:8000/admin/login',{email:loginInfo[1].value,password:loginInfo[2].value})
    .then((response) => {
      if(response.status == 200 && response.data == 1){
        window.location.href="/admin";
       }else{
         response.data.password ? $("input:password").addClass("is-invalid").parent().append(invalid(response.data.password)) : $("input[type=email]").addClass("is-invalid").parent().addClass("mb-5").append(invalid(response.data.email));
       }
    })
    .catch((error) => {
      console.log(error);
    })

  }




  
});

  
</script>
@endsection