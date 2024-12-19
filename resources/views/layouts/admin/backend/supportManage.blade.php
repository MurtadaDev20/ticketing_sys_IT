@extends('layouts.admin.master')
@section('css')
@section('title')
Supports
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Manage Supports </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Manage Supports</li>
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
              <h5 class="card-title">Add New Support</h5>



              <form action="{{route('admin.supportStore')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label class="form-label" for="exampleInputEmail1">Full Name</label>
                  <input name="name" type="text" class="form-control"  value="{{ old('name') }}" aria-describedby="emailHelp">
                  @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="exampleInputEmail1">Email</label>
                  <input name="email" type="email" class="form-control"  value="{{ old('email') }}" aria-describedby="emailHelp">
                  @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="exampleInputEmail1">Password</label>
                  <input name="password" type="password" class="form-control"  value="{{ old('password') }}" aria-describedby="emailHelp">
                  @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>



                <button  class="btn btn-primary">Add User</button>


            </form>


            </form>



          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="page-title">

      <div class="row">
        <div class="col-xl-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="d-block d-md-flex justify-content-between">
                <div class="d-block">
                  <h5 class="card-title pb-0 border-0 mt-3">Data Local</h5>
                </div>
                <div class="d-block d-md-flex clearfix sm-mt-20">



                    <Label class="m-3 fs-3">Search : </Label>
                    <div class="widget-search ml-0 clearfix">
                        <form action="{{ route('admin.support') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{$search}}" placeholder="Search by name or email" aria-label="Search">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>


                </div>


              </div>
              <div class="table-responsive mt-15">
                <table class="table center-aligned-table mb-0">

                  <thead>
                    <tr class="text-dark">
                      <th>#</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                      <th>Active</th>
                    </tr>
                  </thead>

                  <tbody>
                     @foreach ($supports as $key => $support)

                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$support->name}}</td>
                            <td>{{$support->email}}</td>
                            <td>
                                @if ($support->status == 1)
                                <span class="badge bg-success" style="color: white">Enable</span>
                                @else
                                <span class="badge bg-danger" style="color: white">Desable</span>
                                @endif
                            </td>
                            <td>
                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $support->id }}" title="Delete"><i
                                class="fa fa-trash" ></i></button>

                            <!-- Delete Modal -->
                             <div class="modal fade" id="deleteModal-{{ $support->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel-{{ $support->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $support->id }}">Delete User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to delete this user?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{ route('admin.destroySupport', $support->id) }}" class="btn btn-danger color-white" style="color: white">Delete</a>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Edit Button -->
                            <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editModal-{{ $support->id }}">
                                <i class="fa fa-edit"></i>
                            </button>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-{{ $support->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $support->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-{{ $support->id }}">Edit Support</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.updateSupport', $support->id) }}" method="POST">
                                            @csrf
                                            @method('PUT') <!-- Use PUT for updating data -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Full Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $support->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $support->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password (Leave blank if you don't want to change)</label>
                                                    <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </td>

                            <td>
                                @if ($support->status == 1)
                                <a href="{{ route('admin.toggleSupportStatus', $support->id) }}" class="btn" title="Disable"><i class="fa fa-times-circle" style="font-size: 25px;color:red"></i></a>
                                @else
                                <a href="{{ route('admin.toggleSupportStatus', $support->id) }}" class="btn" title="Enable"><i class="fa fa-power-off" style="font-size: 25px;color:green"></i></a>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                  </tbody>




                </table>

                <hr>
                {{ $supports->links() }}
              </div>
            </div>
          </div>
        </div>



      </div>


<!-- row closed -->
@endsection
@section('js')
@endsection
