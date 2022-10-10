@extends('layouts.index');

@section('header')
	        <!-- App favicon -->
			<link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

			<!-- datepicker css -->
			<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

			<!-- Summernote css -->
			<link href="{{asset('assets/libs/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css" />

			<!-- Bootstrap Css -->
			<link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
			<!-- Icons Css -->
			<link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
			<!-- App Css-->
			<link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="row">
	<div class="col-12">
		<div class="container col-lg-12">
			<div class="card">
				<div class="p-5 align-items-center">
					<h3 class="mb-5">Create</h3>
					<form action="/todolist/create" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group row mb-4">
							<label for="name" class="col-form-label col-lg-2">Task Name</label>
							<div class="col-lg-10">
								<input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Task Name...">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label col-lg-2" for="description">Task Description</label>
							<div class="col-lg-10">
								<textarea class="ckeditor form-control" id="description" name="description">

                                </textarea>
								<script>
									// Replace the <textarea id="editor1"> with a CKEditor 4
									// instance, using default configuration.
									// CKEDITOR.replace( 'desc' );
								</script>
							</div>
						</div>
                        <div class="form-group row mb-4">
							<label class="col-form-label col-lg-2">Due-Date</label>
							<div class="col-lg-10">
								<div class="input-daterange input-group" data-provide="datepicker">
									<input type="text" name="due_date" id="due_date" class="form-control" placeholder="Due-Date" name="due_date" />
								</div>
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label col-lg-2">Date line</label>
							<div class="col-lg-10">
								<div class="input-daterange input-group" data-provide="datepicker">
									<input type="text" name="start_date" id="start_date" class="form-control" placeholder="Start Date" />
									<input type="text" name="end_date" id="end_date" class="form-control" placeholder="End Date" />
								</div>
							</div>
						</div>
						<div class="row form-group" style="padding:12px;">
							<input type="submit" value="Create" class="btn btn-primary w-md" style="position: relative; margin-left: auto;">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script> --}}
        <!-- bootstrap datepicker -->
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

        <!-- Summernote js -->
        <script src="{{asset('assets/libs/summernote/summernote-bs4.min.js')}}"></script>

        <!-- form repeater js -->
        <script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/task-create.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>
@endsection
