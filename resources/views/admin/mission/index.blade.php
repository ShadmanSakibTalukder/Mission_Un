<x-master>
    <x-slot:title>
        Missions
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
                    <h4 class="h2">{{__('Missions')}}</h4>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary float-end " data-bs-toggle="modal" data-bs-target="#createModal">
                            <span><i class="fa-solid fa-plus"></i></span>{{__(' Create')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <table class="table table-striped ">
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

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Create Mission</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('missions.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label>Mission Name</label>
                                    <input type="text" name="name" class="form-control" />
                                    @error('name') <small class="text-danger">{($message)}</small> @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" />
                                    @error('country') <small class="text-danger">{($message)}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="2" required></textarea>
                                    @error('address') <small class="text-danger">{($message)}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Commanding Officer (CO)</label>
                                    <input type="text" name="commanding_officer" class="form-control" />
                                    @error('commanding_officer') <small class="text-danger">{($message)}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>CO Email</label>
                                    <input type="text" name="co_email" class="form-control" />
                                    @error('co_email') <small class="text-danger">{($message)}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>MTO </label>
                                    <input type="text" name="mto" class="form-control" />
                                    @error('mto') <small class="text-danger">{($message)}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>MTO Email</label>
                                    <input type="text" name="mto_email" class="form-control" />
                                    @error('mto_email') <small class="text-danger">{($message)}</small> @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-md btn-outline-primary px-3 mx-2">Save</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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