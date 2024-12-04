@extends('layouts.user.master')
@section('css')
@section('title')
All Tickets
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">All tickets </h4>
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
                <div class="my-auto d-block">
                    <a class="btn btn-outline-primary btn-sm mt-2" href="{{route('user.addTickets')}}">Add New Ticket</a>
                </div>




                    {{-- <Label class="m-3 fs-3">Search : </Label>
                                <div class="widget-search ml-0 clearfix">
                                    <form action="{{ route('admin.user') }}" method="GET" class="mb-3">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" value="{{$search}}" placeholder="Search by name or email" aria-label="Search">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </div>
                                    </form>
                                </div> --}}



                </div>


              </div>
              <div class="table-responsive mt-15" >
                <table class="table center-aligned-table mb-0" id="tableContent">

                  <thead>
                    <tr class="text-dark">
                      <th>#</th>
                      <th>Ticket Title</th>
                      <th>Ticket Description</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Solved by</th>
                      <th>Ticket status</th>
                      <th>Created At</th>
                      <th>Closed At</th>
                    </tr>
                  </thead>

                  <tbody>
                     @foreach ($tickets as $key => $ticket)

                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$ticket->ticket_title}}</td>
                            <td>{{ Str::limit($ticket->ticket_desc, 20)  }}</td>
                            <td>{{$ticket->catigory?->cat_name ?? 'null'}}</td>
                            <td>{{ $ticket->subCategory?->sub_cat_name ?? 'null' }}</td>

                            <td>
                                @if($ticket->support_id == null)
                                  none
                                  @else
                                  {{$ticket->support->name}}
                                @endif
                            </td>
                            <td>
                            @if ($ticket->status_id == 1)
                            <span class="badge bg-danger" style="color: white">{{$ticket->status->name}}</span>
                            @elseif ($ticket->status_id == 2)
                            <span class="badge bg-info" style="color: white">{{$ticket->status->name}}</span>
                            @else
                            <span class="badge bg-success" style="color: white">{{$ticket->status->name}}</span>
                            @endif
                            </td>
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
@endsection
