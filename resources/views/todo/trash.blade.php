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

            <!-- Sweet Alert-->
            <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

            <link rel="stylesheet" href="{{ asset('css/style.css') }}">

            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

            // sweet alert

            <script src="sweetalert2.min.js"></script>
            <link rel="stylesheet" href="sweetalert2.min.css">


@endsection

@section('content')

<div class=" filter-bar text-light" id="filter-bar" style="z-index: 999; background: white; ">
    <div>
        <form action="/todolist/trash/filter" id="filter-form" method="post">
            @csrf
            <div class=" px-3 py-4">
                <a href="javascript:void(0);" class=" float-right close-filter">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
                <h5 class="m-0 text-light">Filter</h5>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0 text-light">Name</h6>
            <div class="p-4">
                <input id="name" name="name" type="text" class="form-control" placeholder="Enter Task Name...">
            </div>

            <h6 class="text-center mb-0 text-light">Select date range</h6>
            <div class="p-4">
                {{-- <label for="date-from" class="form-label">From</label>
                <input class=" form-control mb-2" type="date" name="date-from" id="date-from">
                <label for="date-to" class="form-label">To</label>
                <input class=" form-control" type="date" name="date-to" id="date-to">
                <input type="text" class="form-control" name="daterange"> --}}

                <div class="input-daterange " data-provide="datepicker">
                    <input type="text" name="from" id="from" class="form-control"  value="" />
                    <br>
                    <label for="" class="form-label">To</label>
                    <br>
                    <input type="text" name="to" id="to" class="form-control" value="" />
                </div>
            </div>

            <h6 class="text-center mb-0 text-light">Status</h6>
            <div class="p-4">
                {{-- <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Task Name..."> --}}
                <input type="radio" name="status" id="not_completed" value="0">
                <label for="not_completed">Not Completed</label>
                <br>
                <input type="radio" name="status" id="is_completed" value="1">
                <label for="is_completed">Completed</label>
                <br>
                <input type="radio" name="status" id="all" value="all" checked>
                <label for="all">All</label>
            </div>

            <div class="p-4 d-flex justify-content-between">
                <input type="submit" id="apply" name="apply" value="Apply" class="btn btn-info btn-sm waves-effect waves-light">
                <a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm waves-effect waves-light close-filter text-light border-light">Close</a>
            </div>
        </form>

    </div> <!-- end slimscroll-menu-->
</div>

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Trash</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="mb-2 d-flex justify-content-between align-items-baseline">
            <a href="/todolist" class=" text-dark" style="height:fit-content;"><i class="bx bx-left-arrow-alt label-icon"></i> Back</a>
        </div>
        <div class="card">
            <div class="card-body">

                {{-- <h4 class="card-title">Default Datatable</h4> --}}
                <div>
                    <a href="javascript:void(0);" class=" btn header-item noti-icon" id="filter-toggle" style="position: relative; top: -5px; right: 0;" data-toggle="tooltip" data-placement="top" data-title="Filter">
                        <i class="bx bx-filter-alt"></i>
                    </a>
                </div>
                <table id="table_id" class="table table-bordered table-responsive dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; table-layout:fixed;">
                    <thead>
                        <tr>
                            <th class="" style="white-space: nowrap">No.</th>
                            <th class="" style="white-space: nowrap">Name</th>
                            <th class="">Description</th>
                            <th class="col-2">Due date</th>
                            <th class="col-2">Start date</th>
                            <th class="col-2">End date</th>
                            <th class="col-1">Is Complete</th>
                            <th class="col-3">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @php
                            $i = 1
                        @endphp
                        @foreach ($todos as $todo)
                            <tr>
                                <td>{{ $i++}}</td>
                                <td style="white-space: nowrap">{{ $todo->name }}</td>
                                <td style="white-space: nowrap">{!! $todo->description !!}</td>
                                <td style="white-space: nowrap">{{ $todo->due_date }}</td>
                                <td style="white-space: nowrap">{{ $todo->start_date }}</td>
                                <td>{{ $todo->end_date }}</td>
                                <td>
                                    <form action="javascript: void(0);" method="post" class="form-complete">
                                        @csrf
                                        @method('PUT')
                                        @if ($todo->is_completed == 1)
                                            <input type="hidden" name="status" id="status"
                                            value="completed">
                                            <input type="button" value="Completed" class="text-sm-center text-success"
                                            style="background-color:transparent; outline:none; border:none;">
                                        @endif
                                        @if ($todo->is_completed == 0)

                                            <input type="hidden" name="status" id="status"
                                            value="not_completed">
                                            <input type="submit" value="Not Completed" class="text-sm-center text-danger"
                                            style="background-color:transparent; outline:none; border:none;">
                                        @endif
                                    </form>
                                </td>
                                <td style="white-space: nowrap">
                                    <a href="/todolist/{{ $todo->id }}/restore" class="btn btn-outline-secondary btn-sm waves-effect waves-light">Retore</a>
                                    <form action="/todolist/{{ $todo->id }}/forcedelete" method="post" class=" d-inline-block form-delete">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light show_confirm delete" id="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );

          // date rang picker
          $(function() {
            $('input[name="daterange"]').daterangepicker();
        });

        $(document).ready(function () {
            $("#filter-toggle").click(function (e) {
                // $("#filter-bar").toggleClass(".filter-bar-active");
                $("#filter-bar").toggleClass('filter-bar-active');
                // $(selector).toggleClass(className);
            });

            $(".close-filter").click(function (e) {
                $("#filter-bar").removeClass('filter-bar-active');
            });
        });

        $(".form-delete").submit(function (e) {
            e.preventDefault();
            var self = $(this);
            console.log(self.data());
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    location.href = self.attr('action');
                }
            })
        });


    </script>
@endsection
