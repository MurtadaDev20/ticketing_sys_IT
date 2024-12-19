@extends('layouts.admin.master')
@section('css')
@section('title')
Evaluation
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Manage Evaluation </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Manage Evaluation</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->


<div>
    <div class="row">
      <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
          <div class="card-body">
            <div class="card-body">
              <h5 class="card-title">Evaluation</h5>



              <form id="evaluationForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="support">Select Support</label>
                    <select name="support" class="form-control p-2" id="support">
                        <option value="" selected>Choose...</option>
                        @foreach ($supports as $support)
                            <option value="{{$support->id}}">{{$support->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="support-error"></span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for="from">From</label>
                        <input name="from" id="from" type="date" class="form-control">
                        <span class="text-danger" id="from-error"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="to">To</label>
                        <input name="to" id="to" type="date" class="form-control">
                        <span class="text-danger" id="to-error"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Show Evaluation</button>
            </form>

            <!-- Display evaluation result -->
            <div id="evaluationResult" class="mt-4"></div>


          </div>
        </div>
      </div>
    </div>
    </div>




<!-- row closed -->
@endsection
@section('js')
<script>
    $('#evaluationForm').on('submit', function(event) {
        event.preventDefault();

        // Clear previous error messages
        $('#support-error, #from-error, #to-error').text('');

        // Get form data
        var formData = {
            support: $('#support').val(),
            from: $('#from').val(),
            to: $('#to').val(),
            _token: $('input[name="_token"]').val() // CSRF token
        };

        // Send AJAX request
        $.ajax({
            url: "{{ route('admin.Evaluation') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                // Display the evaluation result
                $('#evaluationResult').html(`
                    <p><strong>Support Name:</strong> ${response.support_name}</p>
                    <p><strong>Date Range:</strong> ${response.from}  to ${response.to}</p>
                    <p><strong>Total Degrees:</strong> ${response.sumDegrees}</p>
                    <p><strong>Average Degree:</strong> ${response.averageDegree}</p>
                `);
            },
            error: function(xhr) {
                // Display validation errors
                var errors = xhr.responseJSON.errors;
                if (errors.support) {
                    $('#support-error').text(errors.support[0]);
                }
                if (errors.from) {
                    $('#from-error').text(errors.from[0]);
                }
                if (errors.to) {
                    $('#to-error').text(errors.to[0]);
                }
            }
        });
    });
</script>
@endsection
