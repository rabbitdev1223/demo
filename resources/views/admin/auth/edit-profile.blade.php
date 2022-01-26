@extends('layouts.admin.master')

@section('title')
	Edit Profile
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">

@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>{{trans('user.user_profile')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('user.users')}}</li>
		<li class="breadcrumb-item active">{{trans('user.user_profile')}}</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
			@if(session('success'))	
				<div class="alert alert-primary dark alert-dismissible fade show" role="alert"> {{trans('user.update_profile_success')}}
					<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
				</div>
			@endif
			@if ($errors->any())
			<div class="alert alert-danger dark alert-dismissible fade show" role="alert">{{trans('user.update_profile_failed')}}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
			@endif
	            <div class="">
	                <div class="card">
	                    <div class="card-header pb-0">
	                        <h4 class="card-title mb-0">{{trans('user.user_profile')}}</h4>
	                        <div class="card-options">
	                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
	                        </div>
	                    </div>
	                    <div class="card-body">
	                        <form class="theme-form profile-form" method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />  
							<input type="hidden" name="id" value="{{ $current_user->id }}" />  
							<div class="row mb-2">
	                                <div class="profile-title">
	                                    <div class="media">
											<img class="img-70 rounded-circle" alt="" 
												src="{{asset('uploads/' . $current_user->profile) }}" 
												onerror="onErrorImage(this)"
												id="profileDisplay" onClick="triggerClick()" />
											@if ($errors->has('profile'))
                                    			<div><span class="text-danger text-left">{{ $errors->first('profile') }}</span></div>
                                    		@endif
												<input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
											<div class="media-body">
	                                            <h3 class="mb-1 f-20 txt-primary">{{$current_user->name}}</h3>
	                                            <p class="f-12">
													@if($current_user->type ==1)
														{{trans('user.allevatore')}}
													@elseif($current_user->type ==2)
														{{trans('user.appassionato')}}
													@endif
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.email_address')}}</label>
	                                <input class="form-control" name="email" disabled  value="{{$current_user->email}}" />
									<!-- @if ($errors->has('email'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('email') }}</span></div>
                                    @endif -->
								</div>
						
	                            <div class="mb-3">
	                                <label class="form-label">{{trans('user.nickname')}}</label>
	                                <input class="form-control" name="nickname" placeholder="{{trans('user.nickname')}}"  value="{{old('nickname',$current_user->nickname)}}">
	                            	@if ($errors->has('nickname'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('nickname') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.name')}}</label>
									
	                            	
	                                <input class="form-control" name="name" placeholder="{{trans('user.name')}}"  value="{{old('name',$current_user->name)}}">
	                            	@if ($errors->has('name'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('name') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.surname')}}</label>
	                                <input class="form-control" name="surname" placeholder="{{trans('user.surname')}}"  value="{{old('surname',$current_user->surname)}}">
	                            	@if ($errors->has('surname'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('surname') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.age')}}</label>
	                                <input class="form-control" name="age" type="number" placeholder="{{trans('user.age')}}"  value={{old('age',$current_user->age)}}>
	                            	@if ($errors->has('age'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('age') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
								
									<label class="form-label">{{trans('auth.im_a')}}</label>
									<select class="form-control btn-square" name="type">
										<option value="1" @if ($current_user->type == 1) {{ 'selected' }} @endif>{{trans('user.allevatore')}}</option>
										<option value="2" @if ($current_user->type == 2) {{ 'selected' }} @endif>{{trans('user.appassionato')}}</option>
										
									</select>
								</div>
	                          
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.my_farm_address')}}</label>
	                                <input class="form-control" name="farm_address" placeholder="{{trans('user.my_farm_address')}}"  value="{{$current_user->farm_address}}">
	                            	@if ($errors->has('farm_address'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('farm_address') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.my_city')}}</label>
	                                <input class="form-control" name="city" placeholder="{{trans('user.my_city')}}"  value="{{$current_user->city}}">
	                            	@if ($errors->has('city'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('city') }}</span></div>
                                    @endif
								</div>
								<div class="col-sm-6 col-md-3">
	                                <div class="mb-3">
	                                    <label class="form-label">{{trans('user.my_cap')}}</label>
	                                    <input class="form-control" type="number" name="zipcode" placeholder="{{trans('user.zip_code')}}"  value="{{$current_user->zipcode}}">
	                                	@if ($errors->has('zipcode'))
                                    		<div><span class="text-danger text-left">{{ $errors->first('zipcode') }}</span></div>
                                    	@endif
									</div>
	                            </div>
								@if (Auth::user()->role != 1)
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.current_password')}}</label>
	                                <input class="form-control" type="password" name="current_password" value = "" >
	                            	@if ($errors->has('current_password'))
                                    		<div><span class="text-danger text-left">{{ $errors->first('current_password') }}</span></div>
                                    	@endif
								</div>
								@endif
								<div class="mb-3">
	                                <label class="form-label">{{trans('user.password')}}</label>
	                                <input class="form-control" type="password" name="password"  >
	                            	@if ($errors->has('password'))
                                    		<div><span class="text-danger text-left">{{ $errors->first('password') }}</span></div>
                                    	@endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('auth.password_confirm')}}</label>
	                                <input class="form-control" type="password" name="password_confirmation">
	                            	@if ($errors->has('password_confirmation'))
                                    		<div><span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span></div>
                                    	@endif
								</div>
								<div class="mb-3">	
									<input id="public_profile" type="checkbox"  name="public_profile" value="1" @if ($current_user->public_profile == 1) {{ 'checked' }} @endif>
									<label class="text-muted" for="public_profile" >{{trans('user.make_profile_visible')}}</label>
								</div>	
	                           
	                            <div class="form-footer">
	                                <button class="btn btn-primary btn-block">{{trans('parrot.save')}}</button>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	           
	        </div>
	    </div>
	</div>
	
	@push('scripts')
	<script src="{{ asset('assets/js/parots/profile.js') }}"></script>
	@endpush

@endsection