<x-master>
    <x-slot:title>
        Vehicles
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
                    <h4 class="h2">{{__('Vehicles')}}</h4>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a type="button" href="{{route('vehicles.create')}}" class="btn btn-sm btn-outline-secondary float-end ">
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
                            <th scope="col">Sl</th>
                            <th scope="col">VIN</th>
                            <th scope="col">Captain</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $item)
                        <tr data-toggle="modal" data-target="#myModal{{$item->id}}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->vin_no }}</td>
                            <td>{{ $item->captain }}</td>
                            <td>{{ $item->vin_date }}</td>
                            <!-- <td>{{ $item->status }}</td> -->
                            <td>
                                <a href="" class=" btn btn-sm link-info"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">{{ __('No Vehicles Available') }}</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
        @foreach ($vehicles as $item)
        <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$item->id}}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel{{$item->id}}"> <strong>VIN No : </strong>{{$item->vin_no}}</h4><br>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <p class="mx-5"> Captain : {{$item->captain}}</p>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sl</th>
                                                <th scope="col">Part No</th>
                                                <th scope="col">Nomenclature</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($item->vehicleItems as $vitem)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $vitem->part_no }}</td>
                                                <td>{{ $vitem->nomenclature }}</td>
                                                <td>{{ $vitem->qty }}</td>
                                                <td>
                                                    <a href="" class=" btn btn-sm link-info"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>

                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6">{{ __('No Vehicles Available') }}</td>
                                            </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
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