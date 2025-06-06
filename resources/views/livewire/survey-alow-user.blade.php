<div>
    <div class="row">
        <div class="col-md-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="card-body">
                <h5 class="card-title">Create User Survey</h5>
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

                    <button type="submit" class="btn btn-primary my-3">
                        Add User Survey
                    </button>

                </form>

                <h3 class="text-lg font-bold mt-5">Work flow</h3>
                <div class="table-responsive mt-15 text-center">
                    <table class="mb-0 table table-hover" id="tableContent">
                    <thead>
                        <tr class="text-dark">
                            <th class="border p-2">#</th>
                            <th class="border p-2">UserName</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($surveys as $survey)
                            <tr>
                                <td class="border p-2"> {{$count++}}</td>
                                <td class="border p-2">{{ $survey->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="m-3">
                    {{ $surveys->links() }}
                </div>
                </div>


                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>



