@extends('layouts.support.master')
@section('css')
@section('title')
Tickets Complete
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Tickets Complete</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">All tickets</li>
            </ol>
        </div>
    </div>
</div>
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
                  <h5 class="card-title pb-0 border-0 mt-3">Data Local</h5>
                </div>
                <div class="d-block">
                    <button class="btn btn-outline-success" id="export-tickets-button">Export Excel</button>
                </div>



                </div>


              </div>
              <div class="table-responsive mt-15" >
                <table class="table center-aligned-table mb-0" id="tableContent">

                  <thead>
                    <tr class="text-dark">
                      <th>#</th>
                      <th>Created By Name</th>
                      <th>Created By Email</th>
                      <th>Ticket Title</th>
                      <th>Category</th>
                      <th>Solved by</th>
                      <th>Comment</th>
                      <th>Ticket status</th>
                      <th>Degree</th>
                      <th>Created At</th>
                      <th>Closed At</th>
                    </tr>
                  </thead>

                  <tbody>
                     @foreach ($tickets as $key => $ticket)

                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$ticket->user->name}}</td>
                            <td>{{$ticket->user->email}}</td>
                            <td>{{$ticket->ticket_title}}</td>
                            <td>{{$ticket->catigory->cat_name}}</td>

                            <td>
                                @if($ticket->support_id == null)
                                  none
                                  @else
                                  {{$ticket->support->name}}
                                @endif
                            </td>
                            <td>{{$ticket->comment->comment}}</td>
                            <td>
                            <span class="badge bg-success" style="color: white">{{$ticket->status->name}}</span>

                            </td>
                            <td>{{$ticket->degree}}</td>
                            <td>{{$ticket->created_at}}</td>
                            <td>
                                @if ($ticket->close_ticket_at == null)
                                    <span style="color: red">Ticket Open</span>
                                    @else
                                        {{$ticket->close_ticket_at}}
                                @endif
                                </td>



                        </tr>

                    @endforeach

                  </tbody>




                </table>

                <hr>

                <div class="m-3">{{ $tickets->links() }}</div>
              </div>
            </div>
          </div>
        </div>



      </div>


<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#export-tickets-button').on('click', function() {
            window.location.href = 'export-tickets'; // Redirect to the export route
        });
    });
    </script>
@endsection
