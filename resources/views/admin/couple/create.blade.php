@extends('layouts.admin.master')

@section('title')
	{{trans('couple.new_couple')}}	
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
     <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>{{trans('couple.new_couple')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('couple.couple')}}</li>
		<li class="breadcrumb-item active">{{trans('couple.new_couple')}}</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
			
			@if ($errors->any())
			<div class="alert alert-danger dark alert-dismissible fade show" role="alert">{{trans('couple.failed_to_create_couple')}}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
			@endif
	            <div class="">
	                <div class="card">
	                    <div class="card-header pb-0">
	                        <h4 class="card-title mb-0">{{trans('couple.new_couple')}}</h4>
	                        <div class="card-options">
	                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
	                        </div>
	                    </div>
	                    <div class="card-body">
	                        <form class="theme-form profile-form" method="post" enctype="multipart/form-data" action="{{ route('couple.save') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />    
								<div class="mb-3">
									<label class="form-label">{{trans('couple.male_parrot')}} </label>
									<select class="form-control btn-square" name="male_id" style="display:block">
                                        @foreach($parrots as $parrot)
											@if ($parrot->gender == 1 && $parrot->male_couple == null)
											<option value='{{ $parrot->id }}'>{{ $parrot->parrot_id . " - " . $parrot->name }}</option>
											@endif
										@endforeach
                                    </select>
									@if ($errors->has('male_id'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('male_id') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
									<label class="form-label">{{trans('couple.female_parrot')}} </label>
									<select class="form-control btn-square" name="female_id" style="display:block">
                                        @foreach($parrots as $parrot)
											@if ($parrot->gender == 2 && $parrot->female_couple == null)
											<option value='{{ $parrot->id }}'>{{ $parrot->parrot_id . " - " . $parrot->name }}</option>
											@endif
										@endforeach
                                    </select>
									@if ($errors->has('female_id'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('female_id') }}</span></div>
                                    @endif
								</div>

								<div class="mb-3">	
									<input id="couple_made_today" type="checkbox"  name="couple_made_today" value="1" >
									<label class="text-muted" for="couple_made_today" >{{trans('couple.couple_made_today')}}</label>
									<input class="datepicker-here form-control digits" type="text" data-language="en" name="birth_date_of_couple" readonly style="background:white">
                                    @if ($errors->has('birth_date_of_couple'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('birth_date_of_couple') }}</span></div>
                                    @endif
								</div>	
								<div class="mb-3">	
									
									<label class="text-muted" for="expected_date_of_birth" >{{trans('couple.expected_date_of_birth')}}</label>
									<input class="datepicker-here form-control digits" type="text" data-language="en" name="expected_date_of_birth" readonly style="background:white">
                                    @if ($errors->has('expected_date_of_birth'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('expected_date_of_birth') }}</span></div>
                                    @endif
								</div>
                                
								<div class="mb-3">
	                                <label class="form-label">{{trans('couple.note')}}</label>
	                                <input class="form-control" name="note" type="text" placeholder="{{trans('couple.note')}}" value="{{old('note')}}" >
	                            	
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
	<script>
		
	</script>
	<script src="{{ asset('assets/js/couple/moment.js') }}"></script>
	<script src="{{ asset('assets/js/couple/couple.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script> -->

	@endpush

@endsection