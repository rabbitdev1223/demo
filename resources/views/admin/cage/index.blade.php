@extends('layouts.admin.master')

@section('title')
	{{trans('cage.cage_management')}}

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
			<h3>{{trans('cage.cage_management')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('cage.cage')}}</li>
		<li class="breadcrumb-item active">{{trans('cage.cage_management')}}</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="row">
	        <!-- Ajax data source array start-->
            @if(session('success'))	
					<div class="alert alert-primary dark alert-dismissible fade show" role="alert"> {{trans('cage.updated_success')}}
						<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>	
					</div>
				@endif	
	        <div class="col-sm-12">
	            <div class="card">
	               
	                <div class="card-body">
						<div >
							<a href="{{route('cage.create')}}"><button class="btn btn-square btn-primary btn-sm" type="button" >{{trans('cage.add_cage')}}</button></a>
						</div>
	                    <div class="table-responsive" style="margin-top:20px">
						
	                        <table class="display datatables" id="cagelist">
	                            <thead>
	                                <tr>
	                                    <th>ID</th>
										<th>{{trans('parrot.name')}}</th>
	                                    <th>Dimensioni (L * A * P)</th>
										<th>{{trans('cage.max_parrot')}}</th>
										<th class="center">{{trans('parrot.action')}}</th>
									
	                                </tr>
	                            </thead>
	                            <tbody>
								@foreach ($cages as $cage)
									<tr data-id={{$cage->cage_id}} >
	                                    <td>{{ $cage['cage_id'] }}</td>
										<td>{{ $cage['name'] }}</td>
	                                    <td>{{ $cage['width'] . ' * ' . $cage['height'] . ' * ' . $cage['depth']   }}</td>
										<td>{{ $cage['max_parrot'] }}</td>
                                        <td class=""  >
											
											<a href="{{route('cage.show',$cage->cage_id)}}"><i class="fa fa-eye" ></i></a>&nbsp;
											 <a href="{{route('cage.edit',$cage->cage_id)}}"><i class="fa fa-pencil"></i></a>&nbsp;
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
							<h4 class="modal-title" id="myModalLabel">{{trans('user.are_you_sure')}}</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" id="modal-btn-si">{{trans('parrot.yes')}}</button>
							<button type="button" class="btn btn-primary" id="modal-btn-no">{{trans('parrot.no')}}</button>
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
	
	<script>	
		
	</script>
	<script>
		window.lang ={
			"really_delete": "<?php echo trans('cage.really_delete')?>",
			"success_to_delete": "<?php echo trans('couple.success_to_delete')?>",
			"failed_to_delete": "<?php echo trans('couple.failed_to_delete')?>"
		}
	</script>
	<script src="{{ asset('assets/js/cage/cagelist.js') }}"></script>

	@endpush

@endsection