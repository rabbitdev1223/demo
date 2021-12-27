@extends('admin.authentication.master')

@section('title')login
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
    <section>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-xl-7 order-1"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/1.jpg') }}" alt="looginpage" /></div>
	            <div class="col-xl-5 p-0">
	                <div class="login-card">
	                    <form class="theme-form login-form needs-validation" novalidate="">
	                        <h4>Login</h4>
	                        <h6>Welcome back! Log in to your account.</h6>
	                        <div class="form-group">
	                            <label>Email Address</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-email"></i></span>
	                                <input class="form-control" type="email" required="" placeholder="Test@gmail.com" />
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label>Password</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-lock"></i></span>
	                                <input class="form-control" type="password" name="login[password]" required="" placeholder="*********" />
	                                <div class="show-hide"><span class="show"> </span></div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="checkbox">
	                                <input id="checkbox1" type="checkbox" />
	                                <label class="text-muted" for="checkbox1">Remember password</label>
	                            </div>
	                            <a class="link" href="{{ route('forget-password') }}">Forgot password?</a>
	                        </div>
	                        <div class="form-group">
	                            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
	                        </div>
	                        <div class="login-social-title">
	                            <h5>Sign in with</h5>
	                        </div>
	                        <div class="form-group">
	                            <ul class="login-social">
	                                <li>
	                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram"> </i></a>
	                                </li>
	                            </ul>
	                        </div>
	                        <p>Don't have account?<a class="ms-2" href="{{ route('sign-up') }}">Create Account</a></p>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<script>
	    (function () {
	        "use strict";
	        window.addEventListener(
	            "load",
	            function () {
	                // Fetch all the forms we want to apply custom Bootstrap validation styles to
	                var forms = document.getElementsByClassName("needs-validation");
	                // Loop over them and prevent submission
	                var validation = Array.prototype.filter.call(forms, function (form) {
	                    form.addEventListener(
	                        "submit",
	                        function (event) {
	                            if (form.checkValidity() === false) {
	                                event.preventDefault();
	                                event.stopPropagation();
	                            }
	                            form.classList.add("was-validated");
	                        },
	                        false
	                    );
	                });
	            },
	            false
	        );
	    })();
	</script>


    @push('scripts')
    @endpush

@endsection