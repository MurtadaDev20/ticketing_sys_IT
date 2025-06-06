<div>
    <style>
    .hover-shadow {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .bg-gradient {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
    }

    .card-body {
        padding: 1.5rem;
    }

    .text-primary {
        color: #4e73df !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
    }

    .bg-success {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%) !important;
    }

    .bg-danger {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%) !important;
    }

    .bg-light {
        background-color: #f8f9fc !important;
        border-radius: 10px;
    }

    .fa {
        font-size: 1.1rem;
    }

    .card-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .pagination {
        margin-top: 2rem;
    }

    .pagination .page-link {
        border-radius: 50%;
        margin: 0 3px;
        color: #4e73df;
        border: none;
        padding: 0.5rem 1rem;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
    }

    .pagination .page-link:hover {
        background-color: #f8f9fc;
        color: #224abe;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-white py-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-poll fa-lg text-primary me-2"></i>
                        <h4 class="card-title mb-0">Available Surveys</h4>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        @foreach($surveys as $survey)
                            <div class="col-md-4 mb-4">
                                <div class="card border-0 shadow-sm h-100 hover-shadow">
                                    <div class="card-header bg-gradient bg-primary text-white py-3">
                                        <h5 class="card-title mb-0 text-center text-white">{{ $survey->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div >
                                            <div class="d-flex align-items-center ">
                                                <i class="fa fa-align-left text-primary m-2"></i>
                                                <span class="text-muted mr-1">Description: </span><p class="card-text ps-4">{{ $survey->description }}</p>
                                            </div>
                                            
                                        </div>

                                        <div >
                                            <div class="d-flex align-items-center ">
                                                <i class="fa fa-user text-primary m-2"></i>
                                                <span class="text-muted mr-1">Created By: </span> <p class="card-text ps-4"><b>{{ $survey->user->name }}</b></p>
                                            </div>
                                            
                                        </div>

                                        <div >
                                            <div class="d-flex align-items-center ">
                                                <i class="fa fa-user text-primary m-2"></i>
                                                <span class="text-muted mr-1">Created At: </span> <p class="card-text ps-4">{{ $survey->created_at->diffForHumans() }}</p>
                                            </div>
                                            
                                        </div>

                                        <div >
                                            <div class="d-flex align-items-center ">
                                                <i class="fa fa-info-circle text-primary m-2"></i>
                                                @if ($survey->status == true)
                                                    <span class="text-muted mr-1">Status: </span> <span class="badge bg-success ps-4 text-white">Open</span>
                                                @else
                                                    <span class="text-muted mr-1">Status: </span> <span class="badge bg-danger ps-4 text-white">Closed</span>
                                                @endif
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row text-center mt-4">
                                            <div class="col-12">
                                                <div class="border rounded p-3 bg-light">
                                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                                        <i class="fa fa-question-circle text-primary m-2"></i>
                                                        <h6 class="mb-0">Total Questions</h6>
                                                    </div>
                                                    <h3 class="mb-0 text-primary fw-bold">{{ $survey->questions->count() ?? 0 }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <div class="d-grid">
                                            @if ($survey->status == true)
                                                <a href="{{ route('survey.fill', $survey->id) }}" 
                                                    class="btn btn-primary btn-sm rounded-pill">
                                                        <i class="fa fa-cog m-2"></i>View Questions
                                                </a>
                                            @endif
                                            @if ($survey->status == false)
                                                <button class="btn btn-secondary btn-sm rounded-pill " style="cursor: no-drop;" disabled>
                                                    <i class="fa fa-lock m-2"></i>Closed
                                                </button>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $surveys->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <style>
.hover-shadow:hover {
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    transform: translateY(-2px);
    transition: all .2s ease-in-out;
}
.bg-gradient {
    background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
}
</style> --}}
