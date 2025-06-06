@extends('layouts.user.master')
@section('css')
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #1cc88a;
        --accent-color: #36b9cc;
        --text-color: #5a5c69;
        --light-bg: #f8f9fc;
    }

    body {
        background-color: var(--light-bg);
    }

    .welcome-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        border: none;
        overflow: hidden;
        position: relative;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .welcome-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .welcome-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    .welcome-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--secondary-color);
        border-radius: 2px;
    }

    .welcome-subtitle {
        color: var(--text-color);
        font-size: 1.2rem;
        line-height: 1.8;
        margin-top: 25px;
    }

    .contact-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
        position: relative;
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--accent-color), var(--primary-color));
    }

    .contact-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(78, 115, 223, 0.1);
    }

    .contact-list {
        list-style: none;
        padding: 0;
    }

    .contact-list li {
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius: 10px;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .contact-list li:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
    }

    .contact-list i {
        margin-right: 15px;
        font-size: 1.4rem;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(78, 115, 223, 0.1);
        color: var(--primary-color);
    }

    .contact-list strong {
        color: var(--text-color);
        font-weight: 600;
        margin-right: 10px;
    }

    .emoji {
        font-size: 2rem;
        margin-left: 15px;
        animation: wave 2s infinite;
    }

    @keyframes wave {
        0% { transform: rotate(0deg); }
        10% { transform: rotate(14deg); }
        20% { transform: rotate(-8deg); }
        30% { transform: rotate(14deg); }
        40% { transform: rotate(-4deg); }
        50% { transform: rotate(10deg); }
        60% { transform: rotate(0deg); }
        100% { transform: rotate(0deg); }
    }

    .container-fluid {
        padding: 2rem;
    }

    .card-body {
        padding: 2rem;
    }
</style>

@section('title')
Add New Ticket
@stop
@endsection
@section('page-header')

<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="welcome-card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="d-block">
                            <h3 class="welcome-title">
                                Welcome {{Auth::user()->name}} <span class="emoji">👋</span>
                            </h3>
                            <p class="welcome-subtitle">
                                If you encounter any issues, feel free to create a ticket. Our dedicated team is here to assist you promptly and efficiently.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="contact-card">
                <div class="card-body">
                    <h5 class="contact-title">Contact IT Department</h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="contact-list">
                                <li>
                                    <i class="fa fa-group"></i>
                                    <strong>IT Manager:</strong> 1310
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <strong>IT Support 1:</strong> 1311
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <strong>IT Support 2:</strong> 1312
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <strong>IT Support 3:</strong> 1313
                                </li>
                            </ul>
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
