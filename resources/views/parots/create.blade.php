@extends('layouts.admin.master')

@section('title')
	New Parot
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
     <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
			<h3>New Parot</h3>
		@endslot
		<li class="breadcrumb-item">Parots</li>
		<li class="breadcrumb-item active">New Parot</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
			@if(session('success'))	
				<div class="alert alert-primary dark alert-dismissible fade show" role="alert"> Success!
					Your parrot has been added to your Dashboard!
					<!-- <button class="btn btn-primary" type="button" title="">Add another parot!</button> -->
					<!-- <button class="btn btn-info" type="button"></button> -->
					<a href="javascript:void(0)" class="btn btn-warning " style="position:absolute;right:50px;top:10px">Go to my parot list!</a>
					<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
				</div>
			@endif
			@if ($errors->any())
			<div class="alert alert-danger dark alert-dismissible fade show" role="alert">Failed to create new parot!
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
			@endif
	            <div class="">
	                <div class="card">
	                    <div class="card-header pb-0">
	                        <h4 class="card-title mb-0">New Parot</h4>
	                        <div class="card-options">
	                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
	                        </div>
	                    </div>
	                    <div class="card-body">
	                        <form class="theme-form profile-form" method="post" enctype="multipart/form-data" action="{{ route('parot.save') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />    
							<div class="row mb-2">
	                                <div class="profile-title">
	                                    <div class="media">
											<img class="img-70 rounded-circle" alt="" 
												src = ""
												onerror="onErrorImage(this)"
												id="profileDisplay" onClick="triggerClick()" />
											@if ($errors->has('profileImage'))
                                    			<div><span class="text-danger text-left">{{ $errors->first('profileImage') }}</span></div>
                                    		@endif
												<input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
											
	                                    </div>
	                                </div>
	                            </div>
								<div class="mb-3">
	                                <label class="form-label">Name</label>
	                                <input class="form-control" name="name" placeholder = "Friendly name of the parrot" value="{{old('name')}}" />
									@if ($errors->has('name'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('name') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">Date of Birth</label>
	                                <input class="datepicker-here form-control digits" type="text" data-language="en" name="date_of_birth" readonly style="background:white">
                                    @if ($errors->has('date_of_birth'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('date_of_birth') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
									<label class="form-label">Razza </label>
									<select class="form-control btn-square" name="breed" style="display:block">
                                        @foreach($breeds as $breed)
                                        <option value='{{ $breed->id }}'>{{ $breed->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted" style="display:block" >Is your breed not on the list? Contact us at info@parots.it</small>
								</div>

                                <div class="mb-3">
	                                <label class="form-label">Color</label>
	                                <input class="form-control" name="color" type="text" placeholder="color" value="{{old('color')}}" >
	                            	
								</div>
	                            <div class="form-footer">
	                                <button class="btn btn-primary btn-block">Save</button>
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
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script> -->

	@endpush

@endsection