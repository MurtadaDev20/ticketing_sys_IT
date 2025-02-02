<div>
    <style>
        #table-responsive {
            height: 100vh;
        }
    </style>
    <div class="page-title">
        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <h5 class="card-title pb-0 border-0 mt-3">Data Local</h5>
                            </div>

                            {{-- Search Form --}}
                            <div class="widget-search ml-0 clearfix">
                                <div class="input-group">
                                    <input type="text" wire:model="search" class="form-control" placeholder="Search by name or email" aria-label="Search">
                                    <button class="btn btn-primary" type="button">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-15">
                            <table class="mb-0 table table-hover" id="tableContent">
                                <thead>
                                    <tr class="text-dark">
                                        <th>#</th>
                                        <th>Created By</th>
                                        <th>Ticket Title</th>
                                        <th>Category</th>
                                        <th>Ticket status</th>
                                        <th>Created At</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $key => $ticket)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ticket->user->name }}</td>
                                            <td>{{ $ticket->ticket_title }}</td>
                                            <td>{{ $ticket->catigory->cat_name }} -> {{$ticket->subCategory?->sub_cat_name ?? 'null'}}</td>
                                            <td>
                                                @if ($ticket->status_id == 1)
                                                    <span class="badge bg-danger" style="color: white">{{ $ticket->status->name }}</span>
                                                @elseif ($ticket->status_id == 2)
                                                    <span class="badge bg-info" style="color: white">{{ $ticket->status->name }}</span>
                                                @elseif ($ticket->status_id == 4)
                                                    <span class="badge bg-warning " style="color: white">{{ $ticket->status->name }}</span>

                                                @elseif ($ticket->status_id == 6)
                                                    <span class="badge bg-danger " style="color: white">{{ $ticket->status->name }}</span>
                                                @else
                                                    <span class="badge bg-success" style="color: white">{{ $ticket->status->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $ticket->created_at }}</td>

                                            <td>
                                                <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#editModal-{{ $ticket->id }}" title="show details">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $ticket->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel-{{ $ticket->id }}">Ticket Details</h5>
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
                                                                <hr>
                                                                <label for=""><b>Attach</b></label>
                                                                <br>

                                                                @if ($ticket->ticket_image == null)
                                                                    <span style="color: red">No file attached</span>
                                                                @else
                                                                <p style="color: blue">{{basename($ticket->ticket_image)}}</p>
                                                                <a class="btn btn-outline-success btn-sm"  href="{{route('admin.DownloadFileTickets',$ticket->id)}}" title="Download"> <i class="fa fa-download" title="Download"></i></a>
                                                                @endif

                                                                {{-- <img src="{{ !empty($ticket->ticket_image) ? url('/storage/'.$ticket->ticket_image) : asset('upload/no_image.jpg') }}" class="p-1 bg-black" width="450px" height="450px" alt="Ticket image"> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td >
                                                <button wire:click="approvedTicket({{$ticket->id}})"
                                                    class="btn btn-outline-success btn-sm" title="Approve"><i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <!-- Reject Ticket Button -->
                                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#rejectModal-{{ $ticket->id }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>

                                                    <!-- Reject Ticket Modal -->
                                                    <div class="modal fade" id="rejectModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel-{{ $ticket->id }}" aria-hidden="true" wire:ignore.self>
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="rejectModalLabel-{{ $ticket->id }}">Reject Ticket</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="commentText">Reason for Rejection</label>
                                                                        <textarea class="form-control" wire:model.defer="commentText" id="commentText" cols="30" rows="5" required></textarea>
                                                                        @error('commentText') <span class="text-danger">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger" wire:click="rejectTicket({{ $ticket->id }})" title="Reject Ticket" data-dismiss="modal">Reject</button>
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
    </div>
</div>
</div>
