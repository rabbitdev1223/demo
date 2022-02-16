@extends('layouts.admin.master')

@section('title')
	{{trans('cage.cage_details')}}	
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
			<h3>{{trans('cage.cage_details')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('cage.cage')}}</li>
		<li class="breadcrumb-item active">{{trans('cage.cage_details')}}</li>
	@endcomponent
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
			
			@if(session('success'))	
					<div class="alert alert-primary dark alert-dismissible fade show" role="alert">{{trans('cage.success_to_add_cage')}}
						<!-- <button class="btn btn-primary" type="button" title="">Add another parrot!</button> -->
						<!-- <button class="btn btn-info" type="button"></button> -->
						
						<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
  						<div class="d-flex justify-content-end mt-2">
							  <a href="{{route('cage.create')}}" class="mx-2 btn btn-warning ">{{trans('cage.add_another_cage')}}</a>
							  <a href="{{route('cage.index')}}" class="btn btn-danger mx-2 ">{{trans('cage.goto_cage_list')}}</a>
						</div>
					</div>
				@endif
	            <div class="">
	                <div class="card">
	                    <div class="card-body">
	                        <form class="theme-form profile-form" method="post" enctype="multipart/form-data" action="{{ route('cage.save') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />    
								<div class="row mb-2">
	                                <div class="profile-title">
	                                    <div class="media" style="position: relative;">
											<img class="img-70 rounded-circle" alt="" 
											
												@if ($current_cage->photo)
													src="{{asset('uploads/cages/' . $current_cage->photo) }}" 
												@else
													src=""
												@endif

												onerror="onErrorImage(this)"
												id="profileDisplay"  />
											<!-- <a href="javascript:triggerClick()"><i class="fa fa-pencil circle-icon"
											></i></a> -->
											@if ($errors->has('profileImage'))
                                    			<div><span class="text-danger text-left">{{ $errors->first('profileImage') }}</span></div>
                                    		@endif
												<input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
											
	                                    </div>
	                                </div>
	                            </div>
								<div class="row">
									<div class="mb-3 col-sm-6">
										<label class="form-label">{{trans('cage.name')}}</label>
										<input class="form-control" name="name" maxlength=30 placeholder = "{{trans('cage.friendly_name_of_cage')}}" value="{{$current_cage['name']}}" disabled />
										
									</div>
										
									<div class="mb-3 col-sm-6">
										<label class="form-label">Quanti pappagalli può contenere la gabbia?</label>
										<input class="form-control " name="max_parrot" type="number"  value="{{$current_cage['max_parrot']}}" min=1 disabled>
									</div>
									
									<div class="mb-3 col-sm-6">
										<label class="form-label">Dimensioni</label>

										<div class="input-group mb-3" >
											<span class="input-group-text ms-3">larghezza</span>
											<input class="form-control text-end" name="width" type="number" value="{{$current_cage['width']}}" disabled >
											
											<span class="input-group-text">cm</span>
										</div>
										<div class="input-group mb-3">
											<span class="input-group-text  ms-3">{{'altezza'}}</span>

											<input class="form-control text-end" name="height" type="number"  value="{{$current_cage['height']}}" disabled>
											<span class="input-group-text">cm</span>
										</div>
										<div class="input-group mb-3">
											<span class="input-group-text  ms-3">profondità</span>
										
											<input class="form-control text-end" name="depth" type="number" value="{{$current_cage['depth']}}" disabled>									
											<span class="input-group-text">cm</span>
										</div>
									</div>

								
									<div class="mb-3 col-sm-6">
										<label class="form-label">{{trans('couple.note')}}</label>
										<textarea class="form-control" name="note" rows="5" maxlength=1000 disabled value="{{$current_cage['note']}}"></textarea>
									</div>
									<div class="mb-3">	
										<div class="checkbox checkbox-solid-primary">
											<input  type="checkbox"  name="possibility_add_parrot" value="1" @if ($current_cage->possibility_add_parrot == 1) {{ 'checked' }} @endif disabled>
											<label class="text-muted" for="possibility_add_parrot" >Aggiungi pappagalli al termine della creazione</label>
										</div>
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
	<script>
		$(document).ready(function(){

				$('select[name=male_id]').select2({lang:'it'});
				$('select[name=female_id]').select2({lang:'it'});
				$('input[name=birth_date_of_couple]').datepicker({
				language: 'en',
				dateFormat: 'mm/dd/yyyy',
					maxDate: new Date() // Now can select only dates, which goes after today
				})

				$('input[name=expected_date_of_birth]').datepicker({
					language: 'en',
					dateFormat: 'mm/dd/yyyy',
					minDate: new Date() // Now can select only dates, which goes after today
				})


				$('#couple_made_today').click(function() {
					if ($(this).is(':checked')) {
						// $('input[name=birth_date_of_couple]').datepicker('setDate','12/12/2022');
						var now = new Date();
						var dateString = moment(now).format('MM/DD/YYYY');

						$('input[name=birth_date_of_couple]').val(dateString);
						
						
					}
				});

			});

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