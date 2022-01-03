@extends('layouts.admin.master')

@section('title')
	User Management

@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Ajax DataTables</h3>
		@endslot
		<li class="breadcrumb-item">Tables</li>
		<li class="breadcrumb-item">Data Tables</li>
		<li class="breadcrumb-item active">AJAX</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="row">
	        <!-- Ajax data source array start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Ajax Data Source (Arrays)</h5>
	                    <span>The example below shows DataTables loading data for a table from arrays as the data source, where the structure of the row's data source in this example is:</span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display datatables" id="ajax-data-array">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Ajax data source array end-->
	        <!-- Ajax data source array start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Ajax data source (Objects)</h5>
	                    <span>The example below shows DataTables loading data for a table from arrays as the data source, where the structure of the row's data source in this example is:</span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display datatables" id="ajax-data-object">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Ajax data source array end-->
	        <!-- Ajax  Nested object data start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Nested object data (objects)</h5>
	                    <span>The example below shows DataTables loading data for a table from arrays as the data source, where the structure of the row's data source in this example is:</span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display datatables" id="ajax-data-nested-object">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Ajax Nested object data end-->
	        <!-- Ajax Orthogonal data start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Orthogonal data</h5>
	                    <span>In this example the Ajax source returns an array of objects, which DataTables uses to display the table. The structure of the row's data source in this example is:</span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display datatables" id="orthogonal-data">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Ajax Orthogonal data end-->
	        <!-- Ajax Generated content for a column start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Generated content for a column</h5>
	                    <span>In some tables you might wish to have some content generated automatically.</span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display datatables" id="auto-generate-content">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Ajax Generated content for a column end-->
	        <!-- Ajax Deferred rendering for speed start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Deferred rendering for speed</h5>
	                    <span>The example below shows DataTables with deferred rendering enabled. For this small example you'll likely notice no difference, but larger tables can benefit significantly from simply enabling this parameter.</span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display datatables" id="render-datatable">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	@endpush

@endsection