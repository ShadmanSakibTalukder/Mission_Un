<x-master>
    <x-slot:title>
        Requisitions
    </x-slot:title>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="h2">{{__('Requisitions')}}</h4>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a type="button" href="{{route('requested.create')}}" class="btn btn-sm btn-outline-secondary float-end ">
                            <span><i class="fa-solid fa-plus"></i></span>{{__(' Create')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Requested by.</th>
                            <th scope="col">Reqested Orders</th>
                            <th scope="col">Date</th>
                            <!-- <th scope="col">Status</th> -->
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($quotation as $item)
                        <tr data-toggle="modal" data-target="#myModal{{$item->id}}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->requested_by }}</td>
                            <td>{{ $item->requested_order_no }}</td>
                            <td>{{ $item->requested_date }}</td>
                            <!-- <td>{{ $item->status }}</td> -->
                            <td>
                                <a href="{{route('requested.show',$item->id)}}" class="btn btn-sm link-success"><i class="fa-solid fa-eye fa-lg"></i></a>
                                <!-- <a href="#" class="btn btn-sm link-warning"><i class="fa-solid fa-pen-to-square fa-lg"></i></a> -->

                                <form action="{{route('requested.destroy',$item->id)}}" method="POST" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm link-danger" onclick="return confirm('Are you sure you want to delete?')"><i class="fa-solid fa-trash fs-5"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">{{ __('No requested orders available.') }}</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @foreach ($quotation as $item)
    <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$item->id}}">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel{{$item->id}}">Requisition No : {{$item->requested_order_no}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-4">
                        <div class="row mb-4">
                            <div class="col-12 text-center">
                                <h2>Dhaka Cantonment(CMTD)</h2>
                                <p>Invitation Of Tender</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p><strong>Requisition No:</strong> {{$item->requested_order_no}}</p>
                                <p><strong>Date:</strong> {{$item->requested_date}}</p>
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
                                @foreach ($item->quotationItems as $pitem)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$pitem->part_no}}</td>
                                    <td>{{$pitem->nomenclature}}</td>
                                    <td>{{$pitem->qty}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @push('js')
    <script>
        $(document).ready(function() {
            $('tr[data-toggle="modal"]').click(function() {
                var targetModal = $(this).data('target');
                $(targetModal).modal('show');
            });
        });
    </script>
    @endpush
</x-master>