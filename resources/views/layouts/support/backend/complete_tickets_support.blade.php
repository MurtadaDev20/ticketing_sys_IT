@extends('layouts.support.master')
@section('css')
<style>
    #table-responsive {
        height: 100vh;
    }
</style>
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
                <table class="mb-0 table table-hover" id="tableContent">

                  <thead>
                    <tr class="text-dark">
                      <th>#</th>
                      <th>Created By Name</th>
                      <th>Ticket Title</th>
                      <th>Category</th>
                      <th>Solved by</th>
                      <th>Ticket status</th>
                      <th>Degree</th>
                      <th>Created At</th>
                      <th>Closed At</th>
                      <th>Details</th>
                    </tr>
                  </thead>

                  <tbody>
                     @foreach ($tickets as $key => $ticket)

                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$ticket->user->name}}</td>
                            <td>{{$ticket->ticket_title}}</td>
                            <td>{{$ticket->catigory->cat_name}}</td>

                            <td>
                                @if($ticket->support_id == null)
                                  none
                                  @else
                                  {{$ticket->support->name}}
                                @endif
                            </td>
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

                                <td>
                                    <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#detailsModal-{{ $ticket->id }}" title="show details">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Details Modal -->
                                    <div class="modal fade" id="detailsModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-{{ $ticket->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailsModalLabel-{{ $ticket->id }}">Ticket Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <hr>
                                                <div class="m-3">
                                                    <p><b>Created By Name :</b> {{ $ticket->user->name }}</p>
                                                    <p><b>Created By Email :</b> {{ $ticket->user->email }}</p>
                                                    <p><b>Ticket Category :</b> {{ $ticket->catigory->cat_name }}</p>
                                                    <p><b>Ticket Title :</b> {{ $ticket->ticket_title }}</p>
                                                    <p><b>Ticket Description :</b> {{ $ticket->ticket_desc }}</p>
                                                    <p><b>Ticket Comment :</b> {{ $ticket->comment->comment }}</p>
                                                    <hr>
                                                    <label for=""><b>Attach</b></label>
                                                <br>

                                                @if ($ticket->ticket_image == null)
                                                    <span style="color: red">No file attached</span>
                                                @else
                                                <p style="color: blue">{{basename($ticket->ticket_image)}}</p>
                                                <a class="btn btn-outline-success btn-sm"  href="{{route('support.DownloadFileTickets',$ticket->id)}}" title="Download"> <i class="fa fa-download" title="Download"></i></a>
                                                @endif

                                                {{-- <img src="{{ !empty($ticket->ticket_image) ? url('/storage/'.$ticket->ticket_image) : asset('upload/no_image.jpg') }}" class="p-1 bg-black" width="450px" height="450px" alt="Ticket image"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
