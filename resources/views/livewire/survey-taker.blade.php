<div class="min-vh-100 bg-light">
    <style>
    .bg-light {
        background-color: #f8f9fc !important;
    }

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
        padding: 1.5rem;
    }

    .bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }

    .bg-primary.bg-opacity-10 {
        background: rgba(78, 115, 223, 0.1) !important;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
        background-color: #f8f9fc !important;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        border-color: #4e73df;
        background-color: #fff !important;
    }

    .form-floating > .form-control,
    .form-floating > .form-select {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }

    .form-floating > label {
        padding: 1rem 0.75rem;
        color: #6c757d;
    }

    .form-check {
        transition: all 0.3s ease;
    }

    .form-check:hover {
        transform: translateX(5px);
        background-color: #fff !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .form-check-input {
        width: 1.2em;
        height: 1.2em;
        margin-top: 0.15em;
        border-radius: 0.25em;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .form-check-input:checked {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        border-color: #4e73df;
    }

    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
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

    .btn-lg {
        font-size: 1.1rem;
        padding: 1rem 2rem;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%) !important;
    }

    .badge.bg-danger.bg-opacity-10 {
        background: rgba(231, 74, 59, 0.1) !important;
    }

    .alert {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.25rem;
    }

    .alert-success {
        background-color: rgba(28, 200, 138, 0.1);
        color: #1cc88a;
    }

    .alert-danger {
        background-color: rgba(231, 74, 59, 0.1);
        color: #e74a3b;
    }

    .text-primary {
        color: #4e73df !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .text-danger {
        color: #e74a3b !important;
    }

    .fa {
        font-size: 1.1rem;
    }

    .fa-2x {
        font-size: 2rem;
    }

    .options-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .rounded-3 {
        border-radius: 10px !important;
    }

    .bg-light {
        background-color: #f8f9fc !important;
    }

    .d-grid {
        display: grid;
    }

    .gap-2 {
        gap: 0.5rem !important;
    }
</style>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-4">
                        <div class="text-center mb-3">
                            <div class="bg-primary bg-opacity-10 d-inline-flex p-3 rounded-circle mb-3">
                                <i class="fa fa-poll fa-2x text-white"></i>
                            </div>
                            <h3 class="fw-bold mb-2">{{ $survey->title }}</h3>
                            <p class="text-muted">Please provide your responses below</p>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form wire:submit.prevent="submit">
                            @foreach($survey->questions as $index => $question)
                                <div class="card border-0 mb-4 bg-white shadow-sm">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 mr-2" style="width: 20px; height: 20px; min-width: 20px;">
                                                {{ $index + 1 }}
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-2">{{ $question->question_text }}</h5>
                                                @if($question->required)
                                                    <span class="badge bg-danger bg-opacity-10 text-danger">Required</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if($question->question_type === 'text')
                                            <div class="form-floating">
                                                <input type="text"
                                                    wire:model="answers.{{ $question->id }}"
                                                    class="form-control border-0 bg-light"
                                                    id="q{{ $question->id }}"
                                                    placeholder="Enter your answer" />
                                                <label for="q{{ $question->id }}">Your answer</label>
                                            </div>

                                        @elseif($question->question_type === 'radio')
                                            <div class="options-list">
                                                @foreach($question->options as $opt)
                                                    <div class="form-check p-3 mb-2 bg-light rounded-3">
                                                        <input type="radio"
                                                            wire:model="answers.{{ $question->id }}"
                                                            value="{{ $opt->option_text }}"
                                                            id="q{{ $question->id }}_{{ $opt->id }}"
                                                            class="form-check-input" />
                                                        <label class="form-check-label" for="q{{ $question->id }}_{{ $opt->id }}">
                                                            {{ $opt->option_text }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                        @elseif($question->question_type === 'checkbox')
                                            <div class="options-list">
                                                @foreach($question->options as $opt)
                                                    <div class="form-check p-3 mb-2 bg-light rounded-3">
                                                        <input type="checkbox"
                                                            wire:model="answers.{{ $question->id }}.{{ $opt->id }}"
                                                            class="form-check-input"
                                                            id="q{{ $question->id }}_{{ $opt->id }}" />
                                                        <label class="form-check-label" for="q{{ $question->id }}_{{ $opt->id }}">
                                                            {{ $opt->option_text }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                        @elseif($question->question_type === 'select')
                                            <div class="form-floating">
                                                <select wire:model="answers.{{ $question->id }}" 
                                                    class="form-select border-0 bg-light"
                                                    id="q{{ $question->id }}">
                                                    <option value="">Select an option</option>
                                                    @foreach($question->options as $opt)
                                                        <option value="{{ $opt->option_text }}">{{ $opt->option_text }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="q{{ $question->id }}">Choose an option</label>
                                            </div>
                                        @endif

                                       @error("answers.{$question->id}")
                                        <div class="alert alert-danger mt-3 d-flex align-items-center">
                                            <i class="fa fa-exclamation-circle me-2"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                                    <i class="fa fa-paper-plane me-2"></i>Submit Survey
                                </button>
                            </div>
                        </form>

                        @if(session()->has('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session()->has('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
