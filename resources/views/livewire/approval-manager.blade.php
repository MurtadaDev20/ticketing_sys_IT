<div>
    <div class="row">
        <div class="col-md-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="card-body">
                <h5 class="card-title">Create Approvals</h5>
                <form wire:submit.prevent="addApproval">
                    <div class="mb-2">
                        <label for="category" class="block font-semibold">Select Category:</label>

                        <select wire:model="selectedCategory" id="category"  class="form-control p-2">
                            <option value="">-- Choose a Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                            @endforeach
                        </select>

                        @error('selectedCategory') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2">
                        <label for="user" class="block font-semibold">Select User:</label>

                        <select wire:model="selectedUser" id="user"  class="form-control p-2">
                            <option value="">-- Choose a User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        @error('selectedUser') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary my-3">
                        Add Approval
                    </button>

                </form>

                <h3 class="text-lg font-bold mt-5">Work flow</h3>
                <div class="table-responsive mt-15 text-center">
                    <table class="mb-0 table table-hover" id="tableContent">
                    <thead>
                        <tr class="text-dark">
                            <th class="border p-2">#</th>
                            <th class="border p-2">Approvals</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($approvals as $approval)
                            <tr>
                                <td class="border p-2"> {{$count++}}</td>
                                <td class="border p-2">{{ $approval->user->name }} -> {{ $approval->category->cat_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="m-3">
                    {{ $approvals->links() }}
                </div>
                </div>


                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>



