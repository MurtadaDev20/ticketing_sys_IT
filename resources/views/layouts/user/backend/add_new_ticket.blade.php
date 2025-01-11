@extends('layouts.user.master')
@section('css')
@section('title')
Add New Ticket
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Add New Ticket </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Add New Ticket</li>
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
              <h5 class="card-title">Add New Ticket</h5>



              <form action="{{route('user.storeTickets')}}" method="POST"  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-control p-2" id="category">
                        <option value="" selected>Choose...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                    </select>
                    @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Sub-Category Selection -->
                <div class="mb-3">
                    <label class="form-label">Sub-Category</label>
                    <select name="sub_category" class="form-control p-2" id="sub_category">
                        <option value="">Choose...</option>
                    </select>
                    @error('sub_category') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="exampleInputEmail1">Ticket Title</label>
                  <input name="ticket_title" type="text" class="form-control"  value="{{ old('ticket_title') }}" aria-describedby="emailHelp">
                  @error('ticket_title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="exampleInputEmail1">Ticket Description</label>
                  <textarea name="ticket_description" id="" class="form-control" cols="30" rows="10"  value="{{ old('ticket_description') }}"></textarea>
                  @error('ticket_description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>



                <div class="mb-3">
                    <label for="example-text-input" class="form-label">Attach</label>
                    <input class="form-control" name="image" type="file"  id="image">
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                {{-- <div class="mb-3">

                    <img id="showImage" src="{{ (!empty($ticketData->ticket_image)) ? url('upload/ticket/'.$ticketData->ticket_image) : url('upload/no_image.jpg') }}" alt="" class="rounded-circle p-1 bg-primary" width="110">
                </div> --}}



                <button  class="btn btn-primary">Create Ticket</button>


            </form>


            </form>



          </div>
        </div>
      </div>
    </div>
    </div>




<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#category').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: "{{ route('user.getSubCategories') }}",
                    type: "GET",
                    data: { category_id: categoryId },
                    success: function(data) {
                        $('#sub_category').empty().append('<option value="">Choose...</option>');
                        $.each(data, function(key, value) {
                            $('#sub_category').append('<option value="' + value.id + '">' + value.sub_cat_name + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_category').empty().append('<option value="">Choose...</option>');
            }
        });
    });
</script>
@endsection
