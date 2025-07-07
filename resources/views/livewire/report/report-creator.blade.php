<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <style>
        .simple-form-container {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1.2rem;
            max-width: 520px;
            margin: 2.5rem auto;
            padding: 2.2rem 1.5rem 1.5rem 1.5rem;
            box-shadow: 0 2px 12px 0 rgba(30, 41, 59, 0.06);
        }

        .simple-form-container h5 {
            font-size: 1.35rem;
            font-weight: bold;
            color: #2355d8;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .simple-form-container label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.3rem;
            display: block;
        }

        .simple-form-container input,
        .simple-form-container select {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.7rem;
            margin-bottom: 1.1rem;
            font-size: 1rem;
            background: #f8fafc;
            transition: border 0.2s;
        }

        .simple-form-container input:focus,
        .simple-form-container select:focus {
            border: 1.5px solid #2355d8;
            outline: none;
            background: #fff;
        }

        .simple-form-container .btn-primary {
            background: #2355d8;
            color: #fff;
            border: none;
            border-radius: 0.8rem;
            padding: 0.85rem 2.2rem;
            font-size: 1.08rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background 0.2s;
            display: block;
            width: 100%;
        }

        .simple-form-container .btn-primary:hover {
            background: #1a357a;
        }

        .simple-form-container .text-danger {
            color: #e53e3e;
            font-size: 0.97em;
            margin-top: -0.7rem;
            margin-bottom: 0.8rem;
            display: block;
        }
    </style>

    <div class="simple-form-container">
        <h5>Create User Report</h5>
        <form>
            <!-- Report Type -->
            <label for="user">Select Report Type:</label>
            <select wire:model.lazy="selectReportType" id="user">
                <option value="">-- Choose Report Type --</option>
                <option value="1">New Report</option>
                <option value="2">Modification Report</option>
            </select>
            @error('selectReportType')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            @if ($selectReportType == 2)
                <!-- Folder Path  -->
                <label for="folderPath" class="text-success">Folder Path</label>
                <input wire:model="folderPath" type="text" id="folderPath">
                @error('reportPath')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif

            <!-- Report Name  -->
            <label for="reportName">Report Name</label>
            <input wire:model="reportName" type="text" id="reportName">
            @error('reportName')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <!-- Report Headers -->
            <label>Report Headers</label>
            @foreach ($reportHeaders as $index => $header)
                <input wire:model.lazy="reportHeaders.{{ $index }}" type="text"
                    placeholder="Header {{ $index + 1 }}">
                @error("reportHeaders.$index")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endforeach

            <!-- Report type date -->
            <label for="dateType">Select Report type of date:</label>
            <select wire:model.lazy="selectReportTypeOfDate" id="dateType">
                <option value="">-- type of date --</option>
                <option value="1">Cumulative</option>
                <option value="2">Specific Date</option>
            </select>
            @error('selectReportTypeOfDate')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            @if ($selectReportTypeOfDate == 1)
                <label for="from " class="text-success">From</label>
                <input wire:model="from" type="date" id="from">
                @error('from')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <label for="to" class="text-success">To</label>
                <input wire:model="to" type="date" id="to">
                @error('to')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @elseif($selectReportTypeOfDate == 2)
                <label for="date" class="text-success">Date</label>
                <input wire:model="date" type="date" id="date">
                @error('date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endif

            <!-- Attach Screenshot -->
            <label for="image">Attach</label>
            <input wire:model="image" multiple type="file" id="image">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <!-- Reason Request -->
            <label for="reason">Select Reason:</label>
            <select wire:model="selectReson" id="reason">
                <option value="">-- Select Reason --</option>
                <option value="1">Internal</option>
                <option value="2">Central Bank</option>
                <option value="3">Board</option>
                <option value="4">Regulatory</option>
            </select>
            @error('selectReson')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <button wire:click.prevent='addNewReport' wire:loading.attr="disabled" type="submit" class="btn-primary">
                Create Report
            </button>
            <!-- Loading Spinner -->
            <div wire:loading wire:target="exportData" class="mt-2 text-primary">
                <i class="fa fa-spinner fa-spin me-1"></i> Loading...
            </div>
        </form>
    </div>
</div>
