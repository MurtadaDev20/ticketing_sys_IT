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
                    <a class="btn btn-outline-primary btn-sm mt-2" href="{{route('user.reportCreator')}}">Add a New Report</a>
                </div>


                </div>


              </div>
              <div class="table-responsive mt-15" style=" height: 100vh;">
                <table class="table center-aligned-table mb-0" id="">

                  <thead>
                    <tr class="text-dark">
                      <th>#</th>
                      <th>Report Name</th>
                      <th>Report Type</th>
                      <th>Folder Path</th>
                        <th>Header</th>
                        <th>Type Date</th>
                        <th>Reson Request</th>
                        <th>Status</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Date</th>
                    </tr>
                  </thead>

                  <tbody>
                     @foreach ($reports as $key => $report)

                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{ $report->name }}</td>
                            <td>
                                @if ($report->modification == 1)
                                    <span >New Report</span>
                                @elseif ($report->modification == 2)
                                    <span >Modification Report</span>
                                @endif
                            </td>
                            <td>{{ $report->folder_path }}</td>
                            <td>{{ $report->header }}</td>
                            @if ($report->type_date == 1)
                                <td>Cumulative</td>
                            @elseif ($report->type_date == 2)
                                <td>Specific Dates</td>
                            @else
                                <td>Unknown</td>
                                
                            @endif
                            <td>
                                @if ($report->reson_request == 1)
                                    <span>Internal</span>
                                @elseif ($report->reson_request == 2)
                                    <span>Central Banks</span>
                                @elseif ($report->reson_request == 3)
                                    <span>Board</span>
                                @elseif ($report->reson_request == 4)
                                    <span>Regulatory</span>
                                @else
                                    <span>Unknown</span>
                                @endif
                            </td>
                            <td>
                                @if ($report->status == 1)
                                    <span class="badge badge-success">delivered</span>
                                @elseif ($report->status == 2)
                                    <span class="badge badge-warning">Awaiting Confirmation</span>
                                @elseif ($report->status == 3)
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $report->date_from ?? "N/A"}}</td>
                            <td>{{ $report->date_to ?? "N/A" }}</td>
                            <td>{{ $report->date ?? "N/A" }}</td>
                            

                        </tr>

                    @endforeach

                  </tbody>




                </table>

                <hr>

                <div class="m-3">{{ $reports->links() }}</div>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
</div>