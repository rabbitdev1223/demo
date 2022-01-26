@extends('admin.auth.master')

@section('title')
    Sign Up
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">

@endpush

@section('content')
    <section>
	    <div class="container-fluid p-0">
	        <div class="row m-0">
	            <div class="col-12 p-0">
	                <div class="login-card" >
	                    <form class="theme-form login-form" method="post" action="{{ route('register.perform') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
	                        <h4>Create your account</h4>
	                        <h6>Enter your personal details to create account</h6>
	                        <div class="form-group">
	                            <label>Your Name</label>
	                            <div class="small-group">
	                                <div class="input-group">
	                                    <span class="input-group-text"><i class="icon-user"></i></span>
	                                    <input class="form-control" type="text" name="name" placeholder="Fist Name" value="{{ old('name')}}" />
                                        
                                    </div>
                                    
	                                <div class="input-group">
	                                    <span class="input-group-text"><i class="icon-user"></i></span>
	                                    <input class="form-control"  type="text"  name="surname" placeholder="Last Name" value="{{ old('surname')}}"/>
                                       
                                    </div>
                                 
	                            </div>
                                @if ($errors->has('name'))
                                    <div><span class="text-danger text-left">{{ $errors->first('name') }}</span></div>
                                    @endif
                                @if ($errors->has('surname'))
                                    <div><span class="text-danger text-left">{{ $errors->first('surname') }}</span></div>
                                    @endif
	                        </div>
	                        <div class="form-group">
	                            <label>{{trans('user.email_address')}}</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-email"></i></span>
	                                <input class="form-control" type="email" required="" name="email"  value="{{ old('email')}}" />
                                 
	                            </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                    @endif
	                        </div>
	                        <div class="form-group">
	                            <label>{{trans('user.password')}}</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-lock"></i></span>
	                                <input class="form-control" type="password" name="password" required=""  placeholder="*********" value="{{ old('password')}}" />
	                                <!-- <div class="show-hide"><span class="show"> </span></div> -->
                                       
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                    @endif 
	                        </div>
                    
                            <div class="form-group ">
                                <label >{{trans('auth.password_confirm')}}</label>
                                <div class="input-group">
	                                <span class="input-group-text"><i class="icon-lock"></i></span>
	                                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" value="11111111" required="required">
	                                
	                            </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
	                            <label>{{trans('user.nickname')}}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" type="text" required="" name="nickname" placeholder="Nick Name" value="{{ old('nickname')}}" />
                                </div>
                                @if ($errors->has('nickname'))
                                    <span class="text-danger text-left">{{ $errors->first('nickname') }}</span>
                                @endif
                            </div>
	                        
	                        <div class="form-group">
	                            <div class="checkbox">
	                                <input id="acceptPolicy" type="checkbox"  name="acceptPolicy" value="1"/>
	                                <label class="text-muted" for="acceptPolicy" ></label>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <button class="btn btn-primary btn-block" type="submit">{{trans('auth.create_account')}}</button>
	                        </div>
	                        <div class="login-social-title">
	                            <h5>signup with</h5>
	                        </div>
	                        <!-- <div class="form-group">
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
	                        </div> -->
	                        <p>Already have an account?<a class="ms-2" href="{{ route('login.show') }}">{{trans('auth.sign_in')}}</a></p>
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