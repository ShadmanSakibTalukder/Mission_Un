<x-master>
    <x-slot:title>
        Requisition No : {{$quotation->requested_order_no}}
    </x-slot:title>

    <div class="card-header">
        <h2> Requisitions No : {{$quotation->requested_order_no}}</h2>
        <div class="d-flex justify-content-end align-items-center">
            <a href="{{route('requested.index')}}" class="btn btn-primary btn-sm text-white me-2">Quotation List</a>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2>Dhaka Cantonment(CMTD)</h2>
                <p>Invitation Of Tender</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p><strong>Quotation No:</strong> {{$quotation->requested_order_no}}</p>
                <p><strong>Date:</strong> {{$quotation->requested_date}}</p>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">sl</th>
                    <th scope="col">Part No</th>
                    <th scope="col">Nomenclature</th>
                    <th scope="col">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotation->quotationItems as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->part_no}}</td>
                    <td>{{$item->nomenclature}}</td>
                    <td>{{$item->qty}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-master>