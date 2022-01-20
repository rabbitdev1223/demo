@extends('admin.authentication.master')

@section('title')Forget Password
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endpush

@section('content')
    <section>
	    <div class="container-fluid p-0">
	        <div class="row m-0">
	            <div class="col-12 p-0">
	                <div class="login-card">
	                    <div class="login-main">
	                        <form class="theme-form login-form">
	                           
	                            <h6>Create Your Password</h6>
	                            <div class="form-group">
	                                <label>New Password</label>
	                                <div class="input-group">
	                                    <span class="input-group-text"><i class="icon-lock"></i></span>
	                                    <input class="form-control" type="password" name="login[password]" required="" placeholder="*********" />
	                                    <div class="show-hide"><span class="show"></span></div>
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label>Retype Password</label>
	                                <div class="input-group">
	                                    <span class="input-group-text"><i class="icon-lock"></i></span>
	                                    <input class="form-control" type="password" name="login[password]" required="" placeholder="*********" />
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <div class="checkbox">
	                                    <input id="checkbox1" type="checkbox" />
	                                    <label class="text-muted" for="checkbox1">Remember password</label>
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <button class="btn btn-primary btn-block" type="submit">Done</button>
	                            </div>
	                            <p>Already have an password?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

    @push('scripts')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    @endpush

@endsection