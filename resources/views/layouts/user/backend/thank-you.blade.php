@extends('layouts.user.master')
@section('css')

@livewireStyles
@section('title')
All Survays
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">All Survays </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">All Survays</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<!-- resources/views/livewire/survey-thank-you.blade.php -->
<div class="min-vh-100 bg-light d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <div class="bg-success bg-opacity-10 d-inline-flex p-4 rounded-circle mb-4">
                            <i class="fa fa-check-circle fa-3x text-success"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Thank You!</h2>
                        <p class="lead mb-4">Your responses have been recorded successfully.</p>
                        
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <a href="{{ route('user.main') }}" class="btn btn-primary px-4 mr-2">
                                <i class="fa fa-home me-2"></i> Return Home
                            </a>
                            @if(auth()->check())
                                <a href="{{ route('user.surveyViewUser') }}" class="btn btn-outline-primary px-4">
                                    <i class="fa fa-tachometer-alt me-2"></i> Go to Survays Dashboard
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    }
    .card {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .btn {
        border-radius: 12px;
        padding: 0.85rem 1.75rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
        border: none;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }
    .btn-outline-primary {
        border: 2px solid #4e73df;
    }
    .btn-outline-primary:hover {
        background: #4e73df;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.2);
    }
    .bg-success {
        background: linear-gradient(45deg, #1cc88a, #13855c) !important;
    }
    .text-success {
        color: #1cc88a !important;
    }
    .lead {
        color: #5a5c69;
        font-size: 1.1rem;
    }
    .fa-check-circle {
        animation: scaleIn 0.5s ease-out;
    }
    @keyframes scaleIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>



<!-- row closed -->
@endsection
@section('js')
@livewireScripts
@endsection