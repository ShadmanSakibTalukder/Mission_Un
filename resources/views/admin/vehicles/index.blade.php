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
                            <th scope="col">Mission</th>
                            <th scope="col">Captain</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $item)
                        <tr data-toggle="modal" data-target="#myModal{{$item->id}}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->vin_no }}</td>
                            <td>{{ $item->mission->name }}</td>
                            <td>{{ $item->captain }}</td>
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
                    <p class="mx-5"><strong> Captain :</strong> {{$item->captain}}</p>
                    <p class="mx-5 fs-3 text-info"> <strong>Mission :</strong> {{$item->mission->name}}</p>
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
                                                <th scope="col">Use</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($item->vehicleItems as $vitem)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $vitem->part_no }}</td>
                                                <td>{{ $vitem->nomenclature }}</td>
                                                <td>
                                                    <span class="qty" data-item-id="{{ $vitem->id }}">{{ $vitem->qty }}</span>
                                                </td>
                                                <td>
                                                    <!-- <a href="" class=" btn btn-sm link-danger"><i class="fa-solid fa-hammer">Use</i></a> -->
                                                    <button class="btn btn-sm link-danger usePartButton" data-id="{{ $vitem->id }}">
                                                        <i class="fa-solid fa-hammer">Use</i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="" class=" btn btn-sm link-info"><i class="fa-solid fa-pen-to-square fa-lg">Edit</i></a>

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

            $('.usePartButton').click(function() {
                var itemId = $(this).data('id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Retrieve the CSRF token
                var qtyElement = $('.qty[data-item-id="' + itemId + '"]');

                $.ajax({
                    type: 'POST',
                    url: '/admin/vehicles/update_vehicle/' + itemId, // Adjust the URL as needed
                    data: {
                        _token: csrfToken, // Include the CSRF token in the data
                    },
                    success: function(response) {
                        // Handle the response here, e.g., update the UI
                        console.log(response);
                        if (response.success) {
                            // Update the displayed quantity in real-time
                            qtyElement.text(response.newQty);
                            alert('Part used successfully. New quantity: ' + response.newQty);
                        } else {
                            console.error('Qty update failed.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    @endpush
</x-master>