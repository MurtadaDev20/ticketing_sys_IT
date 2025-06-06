<div class="container py-4">
    <style>
        .statistics-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }
        
        .statistics-card:hover {
            transform: translateY(-5px);
        }
        
        .question-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
        }
        
        .stats-summary {
            background: #f8f9fc;
            padding: 1rem;
            border-radius: 0 0 15px 15px;
        }
        
        .progress-bar-container {
            background: #e9ecef;
            border-radius: 10px;
            height: 25px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }
        
        .progress-bar {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            font-weight: 500;
            font-size: 0.9rem;
            color: white;
            transition: width 0.8s ease;
        }
        
        .stat-item {
            background: white;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #4e73df;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .back-btn {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .print-btn {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }
        
        .back-btn:hover, .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            margin: 1rem 0;
        }
        
        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 2rem;
        }
        
        .sample-response {
            background: #f8f9fc;
            border-left: 4px solid #4e73df;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0 5px 5px 0;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                padding: 20px;
                background: white !important;
                color: black !important;
            }
            
            .statistics-card {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }
            
            .question-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .progress-bar {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Survey Statistics</h1>
            <p class="mb-0 text-muted">{{ $survey->title }}</p>
        </div>
        <div class="no-print">
            <a href="{{ route('survey.responses', $survey->id) }}" class="back-btn">
                <i class="fa fa-arrow-left me-2"></i> Back to Responses
            </a>
            <button onclick="window.print()" class="print-btn">
                <i class="fa fa-print me-2"></i> Print Page
            </button>
        </div>
    </div>

    <!-- Overall Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-item text-center">
                <div class="stat-number">{{ $survey->responses->count() }}</div>
                <div class="stat-label">Total Responses</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item text-center">
                <div class="stat-number">{{ $survey->questions->count() }}</div>
                <div class="stat-label">Questions</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item text-center">
                <div class="stat-number">
                    @if($survey->responses->count() > 0)
                        {{ round($survey->responses->sum(function($response) { return $response->answers->count(); }) / $survey->responses->count(), 1) }}
                    @else
                        0
                    @endif
                </div>
                <div class="stat-label">Avg Answers per Response</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item text-center">
                <div class="stat-number">
                    @if($survey->responses->count() > 0)
                        {{ round(($survey->responses->sum(function($response) { return $response->answers->count(); }) / ($survey->responses->count() * $survey->questions->count())) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </div>
                <div class="stat-label">Completion Rate</div>
            </div>
        </div>
    </div>

    <!-- Question Statistics -->
    @foreach($statistics as $stat)
        <div class="statistics-card">
            <div class="question-header text-center">
                <h5 class="mb-1 text-white">{{ $stat['question']->question_text }}</h5>
                <small class="opacity-75">{{ ucfirst($stat['question']->question_type) }} Question</small>
            </div>
            
            <div class="card-body">
                <!-- Question Summary -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-users text-primary me-2 mr-1"></i>
                            <span><strong>{{ $stat['answered_count'] }}</strong> of {{ $stat['total_responses'] }} responses</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-percentage text-warning me-2"></i>
                            <span>{{ $stat['skip_rate'] }}% skip rate</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-chart-bar text-success me-2"></i>
                            <span>{{ 100 - $stat['skip_rate'] }}% completion rate</span>
                        </div>
                    </div>
                </div>

                <!-- Question-specific Statistics -->
                @if(in_array($stat['question']->question_type, ['radio', 'select']))
                    <!-- Choice Statistics -->
                    @if(!empty($stat['data']))
                        @foreach($stat['data'] as $choice => $data)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-medium">{{ $choice }}</span>
                                    <span class="text-muted">{{ $data['count'] }} ({{ $data['percentage'] }}%)</span>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" 
                                         style="width: {{ $data['percentage'] }}%; background: linear-gradient(135deg, #1cc88a {{ $data['percentage'] }}%, #e9ecef {{ $data['percentage'] }}%);">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no-data">No responses yet</div>
                    @endif

                @elseif($stat['question']->question_type === 'checkbox')
                    <!-- Checkbox Statistics -->
                    @if(!empty($stat['data']['choices']))
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="stat-item">
                                    <div class="stat-number text-info">{{ $stat['data']['total_selections'] }}</div>
                                    <div class="stat-label">Total Selections</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-item">
                                    <div class="stat-number text-success">{{ $stat['data']['avg_selections_per_response'] }}</div>
                                    <div class="stat-label">Avg Selections per Response</div>
                                </div>
                            </div>
                        </div>
                        
                        @foreach($stat['data']['choices'] as $choice => $data)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-medium">{{ $choice }}</span>
                                    <span class="text-muted">{{ $data['count'] }} ({{ $data['percentage'] }}%)</span>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" 
                                         style="width: {{ $data['percentage'] }}%; background: linear-gradient(135deg, #f6c23e {{ $data['percentage'] }}%, #e9ecef {{ $data['percentage'] }}%);">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no-data">No responses yet</div>
                    @endif

                @elseif(in_array($stat['question']->question_type, ['text', 'textarea']))
                    <!-- Text Statistics -->
                    @if(!empty($stat['data']['total_responses']))
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-primary">{{ $stat['data']['total_responses'] }}</div>
                                    <div class="stat-label">Responses</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-info">{{ $stat['data']['avg_word_count'] }}</div>
                                    <div class="stat-label">Avg Words</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-success">{{ $stat['data']['longest_response'] }}</div>
                                    <div class="stat-label">Longest (chars)</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-warning">{{ $stat['data']['shortest_response'] }}</div>
                                    <div class="stat-label">Shortest (chars)</div>
                                </div>
                            </div>
                        </div>
                        
                        @if(!empty($stat['data']['sample_responses']))
                            <h6 class="mt-4 mb-3">Sample Responses:</h6>
                            @foreach($stat['data']['sample_responses'] as $response)
                                <div class="sample-response">
                                    {{ Str::limit($response, 150) }}
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="no-data">No responses yet</div>
                    @endif

                @elseif($stat['question']->question_type === 'number')
                    <!-- Number Statistics -->
                    @if(!isset($stat['data']['no_data']))
                        <div class="row">
                            <div class="col-md-2">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-primary">{{ $stat['data']['count'] }}</div>
                                    <div class="stat-label">Responses</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-success">{{ $stat['data']['average'] }}</div>
                                    <div class="stat-label">Average</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-info">{{ $stat['data']['median'] }}</div>
                                    <div class="stat-label">Median</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-warning">{{ $stat['data']['min'] }}</div>
                                    <div class="stat-label">Minimum</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-danger">{{ $stat['data']['max'] }}</div>
                                    <div class="stat-label">Maximum</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-secondary">{{ $stat['data']['sum'] }}</div>
                                    <div class="stat-label">Sum</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="no-data">No valid numeric responses</div>
                    @endif

                @elseif($stat['question']->question_type === 'date')
                    <!-- Date Statistics -->
                    @if(!isset($stat['data']['no_data']))
                        <div class="row">
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-primary">{{ $stat['data']['count'] }}</div>
                                    <div class="stat-label">Responses</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-success">{{ $stat['data']['earliest'] }}</div>
                                    <div class="stat-label">Earliest Date</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-info">{{ $stat['data']['latest'] }}</div>
                                    <div class="stat-label">Latest Date</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item text-center">
                                    <div class="stat-number text-warning">{{ $stat['data']['date_range_days'] }}</div>
                                    <div class="stat-label">Range (Days)</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="no-data">No valid date responses</div>
                    @endif

                @endif
            </div>
            
            <div class="stats-summary">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Question {{ $loop->iteration }} of {{ count($statistics) }}
                    </small>
                    <small class="text-muted">
                        {{ $stat['answered_count'] > 0 ? 'Response Rate: ' . (100 - $stat['skip_rate']) . '%' : 'No responses yet' }}
                    </small>
                </div>
            </div>
        </div>
    @endforeach

    @if(empty($statistics))
        <div class="text-center py-5">
            <i class="fa fa-chart-bar fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No Statistics Available</h4>
            <p class="text-muted">This survey has no questions or responses yet.</p>
        </div>
    @endif
</div>

<script>
    // You can add additional print-related JavaScript here if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Print button already works with the native window.print() function
    });
</script>