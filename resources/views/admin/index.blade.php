<x-master>
    <x-slot:title>
        Mission UN
    </x-slot:title>
    <style>
        .card-header {
            background-color: lavender;
            color: black;
        }

        .card-body {
            background-color: white;
            color: black;
        }

        table {
            background-color: azure;
            color: black;
        }

        table.table {
            border-color: #ccc;
        }

        table.table th {
            border-color: #ccc;
            background-color: #B0C4DE;
        }

        table.table td {
            border-color: #ccc;
            background-color: white;
        }
    </style>
    @if (session()->has('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session()->has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>

    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">Total Requisition</div>
                    <div class="card-body text-center fs-2"><strong>{{$countMissionQuotation}}</strong></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">Requisition Completed</div>
                    <div class="card-body text-center fs-2"><strong>{{$countMissionCompletedQuotation}}</strong></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">Requisition Under Process</div>
                    <div class="card-body text-center fs-2"><strong>{{$countMissionProcessingQuotation}}</strong></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Total Vehicle</div>
                    <div class="card-body text-center fs-2"><strong>1</strong></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Vehicle Under Maintenance</div>
                    <div class="card-body text-center fs-2"><strong>1</strong></div>
                </div>
            </div>
        </div>

    </div>
    <br><br>
    <h2>Assigned Vehicles</h2>
    <div class="line"></div>
    <br>
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">VIIN No</th>
                <th scope="col">Captain</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($missionVehicles as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$item->vin_no}}</td>
                <td>{{$item->captain}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7"><Strong>No Requisitions Available</Strong></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <br><br>
    <h2>Requsition Under Process</h2>
    <div class="line"></div>
    <br>
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Order No</th>
                <th scope="col">Order Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($missionQuotation as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$item->requested_order_no}}</td>
                <td>{{$item->requested_date}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7"><Strong>No Requisitions Available</Strong></td>
            </tr>
            @endforelse
        </tbody>
    </table>


</x-master>