@extends('layouts.index')

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

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-8" style="line-height: 3em">
        <div class="card p-5">
            <div class="row no-gutters align-items-center">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">Todo</h5>
                    <div class="row border-bottom">
                        <div class="col-md-3">
                            <p class="card-text">Task Name:</p>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $todo->name }}</p>
                        </div>
                    </div>

                    <div class="row border-bottom">
                        <div class="col-md-3">
                            <p class="card-text">Description:</p>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $todo->description }}</p>
                        </div>
                    </div>

                    <div class="row border-bottom">
                        <div class="col-md-3">
                            <p class="card-text">Due Date:</p>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $todo->due_date }}</p>
                        </div>
                    </div>

                    <div class="row border-bottom">
                        <div class="col-md-3">
                            <p class="card-text">Start Date:</p>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $todo->start_date }}</p>
                        </div>
                    </div>

                    <div class="row border-bottom">
                        <div class="col-md-3">
                            <p class="card-text">End Date:</p>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $todo->end_date }}</p>
                        </div>
                    </div>

                    <div class="row border-bottom">
                        <div class="col-md-3">
                            <p class="card-text">Status:</p>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $todo->is_completed==1 ? 'Completed' : 'Not Completed' }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <a href=" /todolist/{{ $todo->id }}/edit" class="btn btn-primary w-md mr-3" >Edit</a>

                        <a href="{{ route('todo.index') }}" class="btn btn-outline-secondary w-md" >Back</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
