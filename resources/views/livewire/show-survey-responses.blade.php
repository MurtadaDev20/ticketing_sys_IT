<div class="container py-4">
    <style>
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .card-statistics {
        background: #fff;
    }

    .card-title {
        font-size: 1.75rem;
        letter-spacing: 0.5px;
    }

    .btn {
        border-radius: 10px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.3s ease;
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

    .btn-outline-danger {
        border: 1px solid #e74a3b;
        color: #e74a3b;
    }

    .btn-outline-danger:hover {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 74, 59, 0.2);
    }

    .btn-outline-success {
        border: 1px solid #1cc88a;
        color: #1cc88a;
    }

    .btn-outline-success:hover {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(28, 200, 138, 0.2);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background: #f8f9fc;
        border-bottom: 2px solid #e3e6f0;
        color: #5a5c69;
        font-weight: 600;
        padding: 1rem;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e3e6f0;
    }

    .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
    }

    .badge.bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }

    .badge.bg-success-subtle {
        background-color: rgba(28, 200, 138, 0.1) !important;
        color: #1cc88a !important;
    }

    .badge.bg-light {
        background-color: #f8f9fc !important;
        color: #6c757d !important;
    }

    .alert {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.25rem;
    }

    .alert-info {
        background-color: rgba(78, 115, 223, 0.1);
        color: #4e73df;
    }

    .bg-light {
        background-color: #f8f9fc !important;
    }

    .text-primary {
        color: #4e73df !important;
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

    .fa {
        font-size: 1.1rem;
    }

    .rounded {
        border-radius: 10px !important;
    }

    .table-responsive {
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }
</style>
    <div class="card card-statistics h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="card-title text-primary fw-bold mb-0">{{ $survey->title }}</h2>
                
                <div class="text-muted">
                    
                    <i class="fa fa-users me-1"></i>
                    {{ $responses->total() }} Responses - 
                    <button wire:loading.class='btn btn-secondary'  wire:loading.attr="disabled" wire:click.prevent='showStatistics' class="btn btn-outline-info btn-sm">
                        <i class="fa fa-chart-bar me-1"></i> Statistics
                    </button>
                            <button wire:click.prevent='exportData' class="btn btn-outline-primary btn-sm" wire:loading.attr="disabled">
                                <i class="fa fa-download me-1"></i> Export
                            </button>

                            <!-- Loading Spinner -->
                            <div wire:loading wire:target="exportData" class="mt-2 text-primary">
                                <i class="fa fa-spinner fa-spin me-1"></i> Exporting responses...
                            </div>
                        @if ($survey->status == true)
                        <button wire:click.prevent='closeSurvey' class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-close me-1"></i> Close
                        </button>
                        @else
                        <button wire:click.prevent='openSurvey' class="btn btn-outline-success btn-sm">
                            <i class="fa fa-check me-1"></i> Open
                        </button>
                        @endif
                </div>
            </div>

            @if($responses->isEmpty())
                <div class="alert alert-info shadow-sm">
                    <i class="fa fa-info-circle me-2"></i>
                    No responses submitted yet.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th class="text-center" style="width: 50px">#</th>
                                <th style="width: 120px">Date</th>
                                @foreach($survey->questions as $question)
                                    <th>{{ $question->question_text }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($responses as $index => $response)
                                <tr>
                                    <td class="text-center align-middle text-white">
                                        <span class="badge bg-primary rounded-pill">{{ $responses->firstItem() + $index }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-clock me-2 text-muted"></i>
                                            <div>
                                                <div>{{ $response->created_at->format('M d, Y') }}</div>
                                                <small class="text-muted">{{ $response->created_at->format('H:i') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach($survey->questions as $question)
                                        <td class="align-middle">
                                            @php
                                                $answer = $response->answers->firstWhere('question_id', $question->id);
                                            @endphp
                                            @if($answer)
                                                @if($question->question_type === 'checkbox')
                                                    <div class="d-flex flex-column gap-1">
                                                        @foreach(explode(',', $answer->answer_text) as $item)
                                                            <span class="badge bg-success-subtle text-success">
                                                                <i class="fa fa-check-circle me-1"></i>
                                                                {{ $item }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="p-2 bg-light rounded">
                                                        {{ $answer->answer_text }}
                                                    </div>
                                                @endif
                                            @else
                                                <span class="badge bg-light text-muted">
                                                    <i class="fa fa-minus-circle me-1"></i>
                                                    No answer
                                                </span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Showing {{ $responses->firstItem() }} to {{ $responses->lastItem() }} of {{ $responses->total() }} responses
                    </div>
                    <div>
                        {{ $responses->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
