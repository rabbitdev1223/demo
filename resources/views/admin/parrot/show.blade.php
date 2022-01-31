@extends('layouts.admin.master')

@section('title')
{{trans('parrot.parrot_details')}}
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
     <!-- Plugins css start-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css')}}"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endpush
<script>
	function onErrorImage(e){
		e.onerror=null;
		e.src="{{asset('assets/images/user/7.jpg')}}";
  }
</script>
@section('content')

	
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
				@if(session('success'))	
					<div class="alert alert-primary dark alert-dismissible fade show" role="alert">{{trans('parrot.success_to_add_parrot')}}
						<!-- <button class="btn btn-primary" type="button" title="">Add another parrot!</button> -->
						<!-- <button class="btn btn-info" type="button"></button> -->
						
						<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
  						<div class="d-flex justify-content-end mt-2">
							  <a href="{{route('parrot.create')}}" class="mx-2 btn btn-warning ">{{trans('parrot.add_another_parrot')}}</a>
							  <a href="{{route('parrot.index')}}" class="btn btn-danger mx-2 ">{{trans('parrot.goto_myparrot_list')}}</a>
						</div>
					</div>
				@endif	
	            <div class="">
	                <div class="card">
	                    <div class="card-header pb-0">
	                        <h4 class="card-title mb-0">{{trans('parrot.parrot_details')}}</h4>
	                        <div class="card-options">
	                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
	                        </div>
	                    </div>
	                    <div class="card-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />    
							<div class="row mb-2">
	                                <div class="profile-title">
	                                    <div class="media">
											<img class="img-70 rounded-circle" alt="" 
											src="{{asset('uploads/parrots/' . $current_parrot->photo) }}"
												onerror="onErrorImage(this)"
												id="profileDisplay" />
										
											
	                                    </div>
	                                </div>
	                            </div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('parrot.name')}}</label>
	                                <input class="form-control" name="name" placeholder = "Friendly name of the parrot" value="{{$current_parrot->name}}" disabled />
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('parrot.unique_id')}}</label>
	                                <input class="form-control" name="unique_id" value="{{$current_parrot->parrot_id}}" disabled />
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('parrot.date_of_birth')}}</label>
	                                <input class="datepicker-here form-control digits" type="text" data-language="en" name="date_of_birth"  value="{{$current_parrot->date_of_birth}}" disabled> 
                                    
								</div>
								<div class="mb-3">
									<label class="form-label">{{trans('parrot.breed')}} </label>
									<select class="form-control btn-square" name="breed" disabled style="display:block">
                                        @foreach($breeds as $breed)
                                        <option value='{{ $breed->id }}' @if($breed->id == $current_parrot->breed_id) {{'selected'}}@endif>{{ $breed->name }}</option>
                                        @endforeach
                                    </select>
								</div>
  								
								<div class="mb-3">
	                                <label class="form-label">{{trans('parrot.gender')}}</label>
	                                <select class="form-control btn-square" name="gender" style="display:block" disabled>
										<option value='0' @if ($current_parrot->gender == 0) {{ 'selected' }} @endif>{{trans('parrot.i_donot_know')}}</option>
										<option value='1' @if ($current_parrot->gender == 1) {{ 'selected' }} @endif>{{trans('parrot.male')}}</option>
                                        <option value='2' @if ($current_parrot->gender == 2) {{ 'selected' }} @endif>{{trans('parrot.female')}}</option>
                                       	 
                                    </select>
								</div>

                                <div class="mb-3">
	                                <label class="form-label">{{trans('parrot.color')}}</label>
	                                <input class="form-control" name="color" type="text" placeholder="color" value="{{$current_parrot->color}}" disabled >
	                            	
								</div>
	                    </div>
	                </div>
	            </div>
	           
	        </div>
	    </div>
	</div>
	
	@push('scripts')
	<!-- <script src="{{ asset('assets/js/parrots/profile.js') }}"></script> -->
    <!-- Plugins JS start-->
    <!-- <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script> -->
    <!-- <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <!-- <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script> -->

	@endpush

@endsection