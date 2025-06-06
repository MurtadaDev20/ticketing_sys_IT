<div>
    <style>
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
    }

    .shadow-sm {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05) !important;
    }

    .card-header {
        border-bottom: none;
        padding: 1.25rem;
    }

    .card-header.bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        border-color: #4e73df;
    }

    .form-control-lg, .form-select-lg {
        font-size: 1.1rem;
    }

    .form-label {
        color: #5a5c69;
        font-weight: 600;
        margin-bottom: 0.5rem;
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

    .input-group-text {
        border-radius: 10px 0 0 10px;
        background-color: #f8f9fc;
        border: 1px solid #e3e6f0;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
    }

    .badge.bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%) !important;
    }

    .badge.bg-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%) !important;
    }

    .form-check-input {
        width: 1.2em;
        height: 1.2em;
        margin-top: 0.15em;
        border-radius: 0.25em;
        border: 1px solid #e3e6f0;
    }

    .form-check-input:checked {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        border-color: #4e73df;
    }

    .questions-list .card {
        transition: all 0.3s ease;
    }

    .questions-list .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }

    .text-danger {
        color: #e74a3b !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .fa {
        font-size: 1.1rem;
    }

    .btn-group .btn {
        padding: 0.375rem 0.75rem;
    }

    .btn-group .btn:first-child {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .btn-group .btn:last-child {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .options-container .input-group {
        transition: all 0.3s ease;
    }

    .options-container .input-group:hover {
        transform: translateX(5px);
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0 text-white text-center">
                        Title: {{ $survey->title }}
                    </h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="addQuestion">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Question</label> 
                                    <input wire:model="question_text" type="text" class="form-control form-control-lg " placeholder="Enter your question">
                                    @error('question_text') 
                                        <span class="text-danger small mt-2 d-block">
                                            <i class="fa fa-exclamation-circle me-1"></i>{{ $message }}
                                        </span> 
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Question Type</label>
                                    <select wire:model="question_type" class="form-select form-control p-2 form-select-lg">
                                        <option value="text">Text Answer</option>
                                        <option value="radio">Single Choice (Radio)</option>
                                        <option value="checkbox">Multiple Choice (Checkbox)</option>
                                        <option value="select">Dropdown Selection</option>
                                    </select>
                                </div>

                                @if(in_array($question_type, ['radio', 'checkbox', 'select']))
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Options</label>
                                        <div class="options-container">
                                            @foreach($options as $index => $option)
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fa fa-circle me-1"></i>
                                                    </span>
                                                    <input wire:model="options.{{ $index }}" 
                                                        type="text" 
                                                        class="form-control" 
                                                        placeholder="Option #{{ $index + 1 }}">
                                                    @if($index > 0)
                                                        <button type="button" 
                                                            class="btn btn-outline-danger" 
                                                            wire:click="removeOption({{ $index }})">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" 
                                            class="btn btn-outline-primary btn-sm mt-2" 
                                            wire:click="addOption">
                                            <i class="fa fa-plus me-1"></i>Add Option
                                        </button>
                                    </div>
                                @endif

                                <div class="form-check mb-4">
                                    <input wire:model="required" type="checkbox" class="form-check-input" id="requiredCheck">
                                    <label class="form-check-label fw-bold" for="requiredCheck">
                                        Required Question
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    Add Question
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        Questions List
                    </h5>
                </div>
                <div class="card-body">
                    <div class="questions-list">
                        @foreach($this->questions as $index => $q)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-2">
                                                <span class="badge bg-primary me-2 text-white">#{{ $index + 1 }}</span>
                                                {{ $q->question_text }}
                                                @if($q->required)
                                                    <span class="badge bg-danger ms-2 text-white">Required</span>
                                                @endif
                                            </h6>
                                            <span class="badge bg-info text-white">
                                                {{ ucfirst($q->question_type) }}
                                            </span>
                                        </div>
                                        <div class="btn-group">
                                            {{-- <button class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-edit me-1"></i>
                                            </button> --}}
                                            @if ($q->answers->count() < 1)
                                                <button class="btn btn-sm btn-outline-danger" 
                                                    wire:click="deleteQuestion({{ $q->id }})"
                                                    wire:confirm="Are you sure you want to delete this question?">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    
                                    @if($q->options->count())
                                        <div class="mt-3 ps-4">
                                            @foreach($q->options as $opt)
                                                <div class="d-flex align-items-center mb-1 text-muted">
                                                    <i class="fa fa-circle m-2 small"></i>
                                                    <span class="small">{{ $opt->option_text }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
