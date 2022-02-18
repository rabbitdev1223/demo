@extends('layouts.admin.master')

@section('title')
{{trans('couple.couple_details')}}
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
     <!-- Plugins css start-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css')}}"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endpush

@section('content')
@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>{{trans('couple.couple_details')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('couple.couple')}}</li>
		<li class="breadcrumb-item active">{{trans('couple.couple_details')}}</li>
	@endcomponent
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
				@if(session('success'))	
					<div class="alert alert-primary dark alert-dismissible fade show" role="alert">{{trans('couple.success_to_add_couple')}}
						<!-- <button class="btn btn-primary" type="button" title="">Add another parrot!</button> -->
						<!-- <button class="btn btn-info" type="button"></button> -->
						
						<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
  						<div class="d-flex justify-content-end mt-2">
							  <a href="{{route('couple.create')}}" class="mx-2 btn btn-warning ">{{trans('couple.add_another_couple')}}</a>
							  <a href="{{route('couple.index')}}" class="btn btn-danger mx-2 ">{{trans('couple.goto_couple_list')}}</a>
						</div>
					</div>
				@endif
	            <div class="">
	                <div class="card">
	                
	                    <div class="card-body">
	                        <form class="theme-form profile-form" >
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />    
							<div class="row">
								<div class="mb-3 col-sm-6">
									<label class="form-label">{{trans('parrot.unique_id')}} </label>
									<input class="form-control" type="text" data-language="en" value="{{$current_couple['couple_id']}}"  disabled >
								
								</div>
								<div class="mb-3 col-sm-6">
									<label class="form-label">{{trans('couple.male_parrot')}} </label>
									<input class="form-control" type="text" data-language="en" value="{{$current_couple['male']['name']}}"  disabled >
								
								</div>
								<div class="mb-3 col-sm-6">
									<label class="form-label">{{trans('couple.female_parrot')}} </label>
									<input class="form-control" type="text" data-language="en" value="{{$current_couple['female']['name']}}"  disabled >
								
								
								</div>

								<div class="mb-3 col-sm-6">	
									<label class="text-muted" for="couple_made_today" >{{trans('couple.couple_made_today')}}</label>
									<input class=" form-control" value="{{$current_couple['birth_date_of_couple']}}" type="text" data-language="en" name="birth_date_of_couple" disabled>
                                    
								</div>	
								<div class="mb-3 col-sm-6">	
									
									<label class="text-muted" for="expected_date_of_birth" >{{trans('couple.expected_date_of_birth')}}</label>
									<input class=" form-control" value="{{$current_couple['expected_date_of_birth']}}" type="text" data-language="en" name="birth_date_of_couple" disabled>
								</div>
                                
								<div class="mb-3 col-sm-6">
	                                <label class="form-label">{{trans('couple.note')}}</label>
	                            	<textarea class="form-control" name="note" rows="3" maxlength=1000 disabled>{{$current_couple['note']}}</textarea>
								</div>
							</div>
	                        
	                        </form>
	                    </div>
	                </div>
	            </div>
	           
	        </div>
	    </div>
	</div>
	
	@push('scripts')

	@endpush

@endsection