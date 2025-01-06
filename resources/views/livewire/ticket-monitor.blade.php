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
                                        <th>Solved by</th>
                                        <th>Assign by</th>
                                        <th>Ticket status</th>
                                        <th>Created At</th>
                                        <th>Closed At</th>
                                        <th>Details</th>
                                        <th>Assign to</th>
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
                                                @if($ticket->support_id == null)
                                                    none
                                                @else
                                                    {{ $ticket->support->name }}
                                                @endif
                                            </td>
                                            <td>
                                                {{$ticket->admin?->name ?? 'null'}}
                                            </td>
                                            <td>
                                                @if ($ticket->status_id == 1)
                                                    <span class="badge bg-danger" style="color: white">{{ $ticket->status->name }}</span>
                                                @elseif ($ticket->status_id == 2)
                                                    <span class="badge bg-info" style="color: white">{{ $ticket->status->name }}</span>
                                                @else
                                                    <span class="badge bg-success" style="color: white">{{ $ticket->status->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $ticket->created_at }}</td>
                                            <td>
                                                @if ($ticket->close_ticket_at == null)
                                                    <span style="color: red">Ticket Open</span>
                                                @else
                                                    {{ $ticket->close_ticket_at }}
                                                @endif
                                            </td>
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
                                                                <label for=""><b>Screenshot</b></label>
                                                                <img src="{{ !empty($ticket->ticket_image) ? asset('upload/ticket/' . $ticket->ticket_image) : asset('upload/no_image.jpg') }}" class="p-1 bg-black" width="450px" height="450px" alt="Ticket image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-3 position-relative">
                                                    <div class="btn-group info-drop info-drop-box xs-mt-10">
                                                        <button type="button" class="dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more-alt"></i></button>
                                                        <div class="dropdown-menu">
                                                            @foreach ($supports as $support)
                                                                <a class="dropdown-item" href="{{ route('admin.assignTo', [$ticket->id, $support->id]) }}">{{ $support->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $ticket->id }}" title="Delete"><i
                                                        class="fa fa-trash" ></i></button>


                                                </td>
                                            <!-- Delete Modal -->


                                        <div class="modal fade" id="deleteModal-{{ $ticket->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteModalLabel-{{ $ticket->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $ticket->id }}">Delete User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                Are you sure you want to delete this user?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="{{ route('admin.destroyTicket', $ticket->id) }}" class="btn btn-danger color-white" style="color: white">Delete</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
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
