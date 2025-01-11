<div>
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

                                <!-- Search form -->
                                <div class="widget-search ml-0 clearfix">
                                    <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Search by name or email" aria-label="Search">
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive mt-15">
                                <table class="mb-0 table table-hover" id="tableContent">
                                    <thead>
                                        <tr class="text-dark">
                                            <th>#</th>
                                            <th>Assign By</th>
                                            <th>Created By Name</th>
                                            <th>Created By Email</th>
                                            <th>Ticket Title</th>
                                            <th>Category</th>
                                            <th>Created At</th>
                                            <th>Details</th>
                                            <th>Close Ticket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $key => $ticket)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ticket->admin->name }}</td>
                                                <td>{{ $ticket->user->name }}</td>
                                                <td>{{ $ticket->user->email }}</td>
                                                <td>{{ $ticket->ticket_title }}</td>
                                                <td>{{ $ticket->catigory->cat_name }} -> {{$ticket->subCategory->sub_cat_name}}</td>
                                                <td>{{ $ticket->created_at }}</td>
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
                                                <td>
                                                    <!-- Close Ticket Button -->
                                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#closeModal-{{ $ticket->id }}">
                                                        <i class="fa fa-check-square"></i>
                                                    </button>

                                                    <!-- Close Ticket Modal -->
                                                <div class="modal fade" id="closeModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel-{{ $ticket->id }}" aria-hidden="true" wire:ignore.self>
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="closeModalLabel-{{ $ticket->id }}">Add Comment</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>


                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="commentText">Comment</label>
                                                                        <textarea class="form-control" wire:model.defer="commentText" id="commentText" cols="30" rows="5" ></textarea>
                                                                        @error('commentText') <span class="text-danger">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" wire:click="closeTicket({{ $ticket->id }})" title="Close Ticket" data-dismiss="modal">Save Changes</button>
                                                                </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="m-3">
                                    {{ $tickets->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        Livewire.on('ticketClosed', () => {

            location.reload();
        });
    </script>
</div>
