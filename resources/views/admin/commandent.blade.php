<x-master>
    <x-slot:title>
        Mission UN
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
    <h4 class="h1">Dashboard</h4>
    <div class="col-md-12 mb-5">
        <h2>Mission Ongoing</h2>
        <div class="line"></div>
        <br>
        <div class="table-responsive d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Missions Name</th>
                        <th scope="col">Country</th>
                        <th scope="col">Commanding Officer</th>
                        <th scope="col">Motot Transport Officer</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($missions as $item)

                    <tr data-toggle="modal" data-target="#myModal{{$item->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->country}}</td>
                        <td>{{$item->commanding_officer}}</td>
                        <td>{{$item->mto}}</td>
                        <td>{{$item->status}}</td>
                    </tr>

                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
        @foreach ($missions as $item)
        <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$item->id}}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel{{$item->id}}"> <strong>Mission Name : </strong>{{$item->name}}</h4><br>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">

                                    <p><strong>Missions Name: {{$item->name}}</strong></p>
                                    <p><strong>Country:</strong> {{$item->country}}</p>
                                    <p><strong>Country:</strong> {{$item->address}}</p>
                                    <p><strong>Commanding Officer:</strong> {{$item->commanding_officer}}</p>
                                    <p><strong>Motot Transport Officer:</strong>{{$item->mto}}</p>
                                    <p><strong>Status:</strong>{{$item->status}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sl</th>
                                                    <th scope="col">VIN</th>
                                                    <th scope="col">Captain</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($item->vehicles as $vitem)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$vitem->vin_no}}</td>
                                                    <td>{{$vitem->captain}}</td>
                                                </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
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