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


                </div>


              </div>
              <div class="table-responsive mt-15" style=" height: 100vh;">
                <table class="table center-aligned-table mb-0" id="">

                  <thead>
                    <tr class="text-dark">
                      <th>#</th>
                      <th>Report Name</th>
                      <th>Crated By</th>
                        <th>Type Date</th>
                        <th>Reson Request</th>
                        <th>Status</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Date</th>
                        <th>Closed At</th>
                        <th>Show</th>
                        <th>Action</th>


                    </tr>
                  </thead>

                  <tbody>
                     @foreach ($reports as $key => $report)

                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->user->name ?? 'N/A' }}</td>
                            
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
                            <td>{{ $report->closed_at ?? "N/A" }}</td>
                            <td>
                                <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#editModal-{{ $report->id }}" title="show details">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal-{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $report->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel-{{ $report->id }}">Report Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="m-3">
                                                <p><b>Report Type :</b>
                                                    @if ($report->modification == 1)
                                                        <span>New Report</span>
                                                    @elseif ($report->modification == 2)
                                                        <span>Modification Report</span>
                                                    @endif
                                                </p>
                                                <p><b>Folder Path :</b> {{ $report->folder_path ?? "New Report"}}</p>
                                                <p><b>Header :</b> {{ $report->header }}</p>
                                                <p><b>Date From :</b> {{ $report->date_from ?? "N/A" }}</p>
                                                <p><b>Date To :</b> {{ $report->date_to ?? "N/A" }}</p>
                                                <p><b>Date :</b> {{ $report->date ?? "N/A" }}</p>
                                                <p><b>Closed At :</b> {{ $report->closed_at ?? "N/A" }}</p>
                                                <hr>
                                                <label for=""><b>Attach</b></label>
                                                <br>

                                                @if ($report->attaches == null)
                                                    <span style="color: red">No file attached</span>
                                                @else 
                                                @foreach ($report->attaches as $attach)
                                                    <p style="color: blue">{{basename($attach->file)}}</p>
                                                @endforeach
                                                
                                                    <a class="btn btn-outline-success btn-sm" wire:click='downloadAllFiles({{ $attach->id }})' title="Download"> <i class="fa fa-download" title="Download"></i></a>
                                                @endif

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td >
                                                <button wire:click="approvedReport({{$report->id}})"
                                                    class="btn btn-outline-success btn-sm" title="Approve"><i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <!-- Reject Ticket Button -->
                                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#rejectModal-{{ $report->id }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                            </td>

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