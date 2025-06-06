<div class="container-fluid">
    <style>
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card-statistics {
        background: #fff;
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .survey-card {
        transition: all 0.3s ease;
    }

    .survey-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .card-header {
        border-bottom: none;
        padding: 1.25rem;
    }

    .card-header.bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        border-color: #4e73df;
    }

    .input-group-text {
        border-radius: 10px 0 0 10px;
        background-color: #f8f9fc;
        border: 1px solid #e3e6f0;
    }

    .btn {
        border-radius: 10px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }

    .btn-outline-primary {
        border: 1px solid #4e73df;
        color: #4e73df;
    }

    .btn-outline-primary:hover {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.2);
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

    .text-primary {
        color: #4e73df !important;
    }

    .text-success {
        color: #1cc88a !important;
    }

    .border {
        border-color: #e3e6f0 !important;
    }

    .progress {
        height: 6px !important;
        border-radius: 10px;
        background-color: #f8f9fc;
    }

    .progress-bar {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
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

    .text-danger {
        color: #e74a3b !important;
    }

    .form-label {
        color: #5a5c69;
        font-weight: 500;
    }

    .shadow-sm {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05) !important;
    }
</style>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <!-- Create Survey Section -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="fa fa-plus-circle text-primary me-2"></i>
                                Create New Survey
                            </h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="addNewSurvay">
                                <div class="mb-3">
                                    <label class="form-label fw-medium" for="surveyTitle">Survey Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fa fa-heading"></i>
                                        </span>
                                        <input wire:model='survay_title' type="text" class="form-control" id="surveyTitle" value="{{ old('survay_title') }}" placeholder="Enter survey title">
                                    </div>
                                    @error('survay_title') 
                                        <div class="text-danger mt-1">
                                            <i class="fa fa-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium" for="surveyDescription">Survey Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fa fa-align-left"></i>
                                        </span>
                                        <textarea wire:model='survay_description' id="surveyDescription" class="form-control" rows="3" placeholder="Enter survey description">{{ old('survay_description') }}</textarea>
                                    </div>
                                    @error('survay_description') 
                                        <div class="text-danger mt-1">
                                            <i class="fa fa-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus-circle me-1"></i>
                                    Create Survey
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Surveys List Section -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fa fa-poll text-primary me-2"></i>
                                    Your Surveys
                                </h5>
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fa fa-filter me-1"></i> Filter
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fa fa-sort me-1"></i> Sort
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($surveys as $survey)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow-sm survey-card border-0">
                                            <div class="card-header bg-primary text-white ">
                                                <h5 class="card-title mb-0 text-white">{{ $survey->title }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div >
                                                    <div class="d-flex align-items-center ">
                                                        <i class="fa fa-align-left text-primary mr-2"></i>
                                                        <span class="text-muted mr-1">Description: </span><p class="card-text ps-4">{{ $survey->description }}</p>
                                                    </div>
                                                    
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                        <i class="fa fa-info-circle text-primary mr-2"></i>
                                                        @if ($survey->status == true)
                                                            <span class="text-muted mr-1">Status: </span> <span class="badge bg-success ps-4 text-white">Open</span>
                                                        @else
                                                            <span class="text-muted mr-1">Status: </span> <span class="badge bg-danger ps-4 text-white">Closed</span>
                                                        @endif
                                                        
                                                    </div>

                                                <div class="row text-center g-3 mb-4">
                                                    <div class="col-6">
                                                        <div class="border rounded p-3 bg-light">
                                                            <i class="fa fa-question-circle text-primary mb-2 fa-lg"></i>
                                                            <h6 class="mb-1">Questions</h6>
                                                            <h4 class="mb-0 text-primary">{{ $survey->questions->count() ?? 0 }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="border rounded p-3 bg-light">
                                                            <i class="fa fa-users text-success mb-2 fa-lg"></i>
                                                            <h6 class="mb-1">Responses</h6>
                                                            <h4 class="mb-0 text-success">{{ $survey->responses->count() ?? 0 }}</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="mb-4">
                                                    @php
                                                        $completionRate = ($survey->answers_count ?? 0) > 0 
                                                            ? (($survey->answers_count / ($survey->questions_count ?? 1)) * 100) 
                                                            : 0;
                                                    @endphp
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <span class="text-muted small">Completion Rate</span>
                                                        <span class="text-muted small">{{ round($completionRate) }}%</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $completionRate }}%"></div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="card-footer bg-white border-top-0">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('user.survey.questions', $survey->id) }}" class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-cog me-1"></i>Manage Questions
                                                    </a>
                                                    <a href="{{ route('survey.responses', $survey->id) }}" class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-chart-bar me-1"></i>View Responses
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <div class="d-flex justify-content-center">
                                {{ $surveys->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
