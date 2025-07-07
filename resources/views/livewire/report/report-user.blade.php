<div>
    <div class="row">
        <div class="col-md-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="card-body">
                <h5 class="card-title">Create User Report</h5>
                <form wire:submit.prevent="addSurvayUser">
                    
                    <div class="mb-2">
                        <label for="user" class="block font-semibold">Select User:</label>

                        <select wire:model="selectedUser" id="user"  class="form-control p-2">
                            <option value="">-- Choose a User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id ?? null }}">{{ $user->name ?? null }}</option>
                            @endforeach
                        </select>

                        @error('selectedUser') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2">
                        <label for="user" class="block font-semibold">Select Role:</label>

                        <select wire:model="selectStatus" id="user"  class="form-control p-2">
                            <option value="">-- Choose a Role --</option>
                            <option value="1">Creator</option>
                            <option value="2">Admin</option>
                            
                        </select>

                        @error('selectStatus') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary my-3">
                        Add User Report
                    </button>

                </form>

                <h3 class="text-lg font-bold mt-5">Work flow</h3>
                <div class="table-responsive mt-15 text-center">
                    <table class="mb-0 table table-hover" id="tableContent">
                    <thead>
                        <tr class="text-dark">
                            <th class="border p-2">#</th>
                            <th class="border p-2">UserName</th>
                            <th class="border p-2">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($reports as $report)
                            <tr>
                                <td class="border p-2"> {{$count++}}</td>
                                <td class="border p-2">{{ $report->user->name }}</td>
                                @if($report->status == 1 )
                                <td class="border p-2 text-danger">Creator Report</td>
                                @else
                                <td class="border p-2 text-success">Admin Report</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="m-3">
                    {{ $reports->links() }}
                </div>
                </div>


                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>



