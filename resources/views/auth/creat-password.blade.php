@extends('auth.master')

@section('title')
	Create Password
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
	                    <form class="theme-form login-form" method="post"  action="{{ route('password.init') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<input type="hidden" name="token" value="{{ isset($token)?$token: ''}}" />
							<h4 class="mb-3">Create Your Password</h4>
	                        <div class="form-group">
	                            <label>New Password</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-lock"></i></span>
	                                <input class="form-control" type="password" name="password" required=""  />
	                                <div class="show-hide"><span class="show"></span></div>
	                            </div>
								@if ($errors->has('password'))
                                    		<div><span class="text-danger text-left">{{ $errors->first('password') }}</span></div>
                                    	@endif
	                        </div>
	                        <div class="form-group">
	                            <label>Password Confirm</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-lock"></i></span>
	                                <input class="form-control" type="password" name="password_confirmation" required="" placeholder="" />
	                            </div>
								@if ($errors->has('password_confirmation'))
                                    		<div><span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span></div>
                                    	@endif
	                        </div>
	                        <div class="form-group">
	                            <button class="btn btn-primary btn-block" type="submit">Done</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

    @push('scripts')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    @endpush

@endsection