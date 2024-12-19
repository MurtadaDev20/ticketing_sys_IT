@extends('layouts.user.master')
@section('css')
@section('title')
Add New Ticket
@stop
@endsection
@section('page-header')

<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div>

    <div class="page-title">

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block">
                                <h3 class="card-title pb-0 border-0 mt-3 text-success">Welcome  -- {{Auth::user()->name}} 😊 -- I hope you are well today</h3>
                                <h5> -- If you encounter a problem, you can create a ticket, and we will resolve it as soon as possible</h5>



                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    {{-- <div class="page-title">

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body p-4">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block">

                                <p>
                                    A ticketing system is a powerful tool used to manage, track, and prioritize customer or employee requests efficiently.
                                    <br>
                                    It allows users to report issues, make inquiries, or request services, while enabling support teams to organize, monitor, and resolve these tickets systematically.
                                    <br>
                                    By streamlining communication and tracking the status of every ticket, the system improves response times, ensures accountability,
                                    <br>
                                    and enhances overall satisfaction. It's an essential solution for maintaining organized workflows and delivering quality support.
                                </p>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div> --}}
    <div class="page-title">

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 class="card-title">Contact Us IT Department</h5>
                            <div class="row">
                              <div class="col-sm-6">
                                <ul class="list list-unstyled mb-30">
                                  <li> <i class="fa fa-group text-primary"></i> <strong>IT Manager:</strong> 1310 </li>
                                  <li> <i class="fa  fa-phone text-success"></i><strong>IT Support 1:</strong> 1311</li>
                                  <li> <i class="fa  fa-phone text-success"></i><strong>IT Support 2:</strong> 1312</li>
                                  <li> <i class="fa  fa-phone text-success"></i><strong>IT Support 3:</strong> 1313</li>
                                </ul>
                              </div>

                            </div>
                          </div>
                    </div>
                </div>
            </div>
    </div>
</div>


<!-- row closed -->
@endsection
@section('js')

@endsection
