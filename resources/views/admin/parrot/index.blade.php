@extends('layouts.admin.master')

@section('title')
	{{trans('parrot.parrot_management')}}

@endsection

@push('css')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}"> 
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
 
@endpush

@section('content')
@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>{{trans('parrot.my_parrots')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('parrot.parrot')}}</li>
		<li class="breadcrumb-item active">{{trans('parrot.my_parrots')}}</li>
	@endcomponent
	<div class="container-fluid">
	    <div class="row">
	        <!-- Ajax data source array start-->
            @if(session('success'))	
					<div class="alert alert-primary dark alert-dismissible fade show" role="alert"> {{trans('parrot.updated_success')}}
						<!-- <button class="btn btn-primary" type="button" title="">Add another parrot!</button> -->
						<!-- <button class="btn btn-info" type="button"></button> -->
						
						<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
  						
					</div>
				@endif	
	        <div class="col-sm-12">
	            <div class="card">
	              
	                <div class="card-body">
						<div >
							<a href="{{route('parrot.create')}}"><button class="btn btn-square btn-primary btn-sm" type="button" >{{trans('parrot.new_parrot')}}</button></a>
						</div>
	                    <div class="table-responsive" style="margin-top:20px">

						
	                        <table class="display datatables" id="parrotlist">
	                            <thead>
	                                <tr>
										
	                                    <th>ID</th>
										<th>{{trans('parrot.name')}}</th>
	                                    <th>{{trans('parrot.gender')}}</th>
										<th>{{trans('parrot.breed')}}</th>
										<th class="center">{{trans('parrot.action')}}</th>
									
	                                </tr>
	                            </thead>
	                            <tbody>
								@foreach ($parrots as $parrot)
									<tr data-id={{$parrot->id}}  data-couple="{{$parrot['is_couple']}}">
										
	                                    <td>{{ $parrot['parrot_id'] }}</td>
										<td>{{ $parrot['name'] }}</td>
										<td>{{$parrot['gender']==1?trans('parrot.male'):trans('parrot.female')}}</td>
	                                    <td>{{ $parrot['breed']['name'] }}</td>
                                        <td class="" data-couple="{{$parrot['is_couple']}}" >
											
											<a href="{{route('parrot.show',$parrot->id)}}"><i class="fa fa-eye" ></i></a>&nbsp;
											 <a href="{{route('parrot.edit',$parrot->id)}}"><i class="fa fa-pencil"></i></a>&nbsp;
											 <a href="#"><i class="fa fa-trash" role='button'></i></a>
											
											</td>
			
	                                </tr>
								@endforeach
								</tbody>
	                        </table>
	                    </div>
	                </div>

	            </div>
				<!--modal dialog-->	
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
					<div class="modal-dialog ">
						<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" id="modal-btn-si">Yes</button>
							<button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
						</div>
						</div>
					</div>
				</div>
				<!---------->
				
	        </div>
	        <!-- Ajax data source array end-->
	        
	    </div>
		<!--Toast-->
		<!-- @component('components.toast')	
		@endcomponent -->
	
		<!----------->
	</div>
	

	@push('scripts')
	<!-- <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
	<script src="{{ asset('assets/js/notify/notify-script.js')}}"></script>
	<script src="{{ asset('assets/js/parrots/datatable.js') }}"></script>

	@endpush

@endsection