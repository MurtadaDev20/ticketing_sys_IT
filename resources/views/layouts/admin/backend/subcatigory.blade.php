@extends('layouts.admin.master')
@section('css')
@section('title')
Catigories
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Catigories </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Catigories</li>
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
              <h5 class="card-title">Add New Catigory</h5>



              <form action="{{ route('admin.addSubCategory') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="exampleInputEmail1">Parent Category</label>
                    <select name="catigory_id" class="form-control p-2" id="">
                      <option value="" selected>Choose...</option>
                      @foreach ($catigories as $category)
                      <option value="{{$category->id}}">{{$category->cat_name}}</option>
                      @endforeach

                    </select>
                    @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>

                <div class="mb-3">
                    <label for="sub_cat_name">Subcategory Name</label>
                    <input name="sub_cat_name" type="text" class="form-control">
                    @error('sub_cat_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button class="btn btn-primary">Add Subcategory</button>
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



                  <div class="widget-search ml-0 clearfix">

                  </div>


                </div>


              </div>
              <div class="table-responsive mt-15">
                <table class="table center-aligned-table mb-0">
                  <thead>
                    <tr class="text-dark">
                      <th>#</th>
                      <th>Parent Category</th>
                      <th>Subcategory Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subcatigories as $key => $subcatigory)

                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$subcatigory->category->cat_name}}</td>
                            <td>{{$subcatigory->sub_cat_name}}</td>
                            <td>
                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $subcatigory->id }}"><i
                                    class="fa fa-trash"></i></button>

                                <!-- Delete Modal -->
                                 <div class="modal fade" id="deleteModal-{{ $subcatigory->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel-{{ $subcatigory->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel-{{ $subcatigory->id }}">Delete User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to delete this user?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="{{ route('admin.destroySubCatigory', $subcatigory->id) }}" class="btn btn-danger color-white" style="color: white">Delete</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- Edit Button -->
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editModal-{{ $subcatigory->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal-{{ $subcatigory->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $subcatigory->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel-{{ $subcatigory->id }}">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.updateSubCatigory', $subcatigory->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') <!-- Use PUT for updating data -->
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Full Name</label>
                                                            <select name="catigory_id" value="{{$subcatigory->category->cat_name}}" class="form-control p-2" id="">
                                                                <option value="" selected>Choose...</option>
                                                                @foreach ($catigories as $category)
                                                                <option value="{{$category->id}}">{{$category->cat_name}}</option>
                                                                @endforeach

                                                              </select>
                                                              @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sub_cat_name">Subcategory Name</label>
                                                            <input name="sub_cat_name" type="text" value="{{$subcatigory->sub_cat_name}}" class="form-control">
                                                            @error('sub_cat_name') <span class="text-danger">{{ $message }}</span> @enderror
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

                        </tr>
                    @endforeach

                  </tbody>


                </table>
                <hr>
              </div>
            </div>
          </div>
        </div>



      </div>


<!-- row closed -->
@endsection
@section('js')
@endsection
