@extends('layouts.admin.master')

@section('title')
	User Detail
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">

@endpush
<script>
	function onErrorImage(e){
		e.onerror=null;
		e.src="{{asset('assets/images/user/7.jpg')}}";
  }
</script>
@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>User Detail</h3>
		@endslot
		<li class="breadcrumb-item">Users</li>
		<li class="breadcrumb-item active">User Detail</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
			    <div >
	                <div class="card">
	                    <div class="card-header pb-0">
	                        <h4 class="card-title mb-0">User Detail</h4>
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
												id="profileDisplay"  />
											@if ($errors->has('profile'))
                                    			<div><span class="text-danger text-left">{{ $errors->first('profile') }}</span></div>
                                    		@endif
												<input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
											<div class="media-body">
	                                            <h3 class="mb-1 f-20 txt-primary">{{$current_user->name}}</h3>
	                                            <p class="f-12">
													@if($current_user->type ==1)
														allevatore
													@elseif($current_user->type ==2)
														appassionato
													@endif
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="mb-3">
	                                <label class="form-label">Email-Address</label>
	                                <input class="form-control" name="email" disabled  value="{{$current_user->email}}" />
									<!-- @if ($errors->has('email'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('email') }}</span></div>
                                    @endif -->
								</div>
						
	                            <div class="mb-3">
	                                <label class="form-label">NickName</label>
	                                <input class="form-control" name="nickname"  value="{{old('nickname',$current_user->nickname)}}" disabled>
	                            	@if ($errors->has('nickname'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('nickname') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">Name</label>
									
	                            	
	                                <input class="form-control" name="name"  value="{{old('name',$current_user->name)}}" disabled>
	                            	@if ($errors->has('name'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('name') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">Surname</label>
	                                <input class="form-control" name="surname"  value="{{old('surname',$current_user->surname)}}" disabled>
	                            	@if ($errors->has('Surname'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('surname') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">Age</label>
	                                <input class="form-control" name="age" type="number" disabled  value={{old('age',$current_user->age)}} disabled>
	                            	@if ($errors->has('age'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('age') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
									<label class="form-label">I'm a </label>
									<select class="form-control btn-square" name="type" disabled>
										<option value="0"@if ($current_user->type == 0) {{ 'selected' }} @endif></option>
										<option value="1" @if ($current_user->type == 1) {{ 'selected' }} @endif>allevatore</option>
										<option value="2" @if ($current_user->type == 2) {{ 'selected' }} @endif>appassionato</option>
										
									</select>
								</div>
	                          
								<div class="mb-3">
	                                <label class="form-label">My Farm address</label>
	                                <input class="form-control" name="farm_address"  value="{{$current_user->farm_address}}" disabled>
	                            	@if ($errors->has('farm_address'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('farm_address') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">My City</label>
	                                <input class="form-control" name="city"  value="{{$current_user->city}}" disabled>
	                            	@if ($errors->has('city'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('city') }}</span></div>
                                    @endif
								</div>
								<div class="col-sm-6 col-md-3">
	                                <div class="mb-3">
	                                    <label class="form-label">My Cap</label>
	                                    <input class="form-control" type="number" name="zipcode"  value="{{$current_user->zipcode}}" disabled>
	                                	@if ($errors->has('zipcode'))
                                    		<div><span class="text-danger text-left">{{ $errors->first('zipcode') }}</span></div>
                                    	@endif
									</div>
	                            </div>
								<div class="col-sm-6 col-md-3">
	                                <div class="mb-3">
	                                    <label class="form-label">Least Login Date</label>
	                                    <input class="form-control"  value="{{$current_user->login_date}}" disabled>
	                                										</div>
	                            </div>
                                <div class="col-sm-6 col-md-3">
	                                <div class="mb-3">
	                                    <label class="form-label">Login IP</label>
	                                    <input class="form-control"  value="{{$current_user->login_ip}}" disabled>
	                                										</div>
	                            </div>
                                <div class="col-sm-6 col-md-3">
	                                <div class="mb-3">
	                                    <label class="form-label">Registerd Date</label>
	                                    <input class="form-control"  value="{{$current_user->created_at}}" disabled>
	                                										</div>
	                            </div>
								<div class="mb-3">	
									<input id="public_profile" type="checkbox"  name="public_profile" value="1" @if ($current_user->public_profile == 1) {{ 'checked' }} @endif disabled>
									<label class="text-muted" for="public_profile" >Make my profile visible in public?</label>
								</div>	
	                           
	       
	                        </form>
	                    </div>
	                </div>
	            </div>
	           
	        </div>
	    </div>
	</div>
	
@endsection