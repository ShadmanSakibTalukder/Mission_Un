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
                    {{-- <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">VIN</th>
                            <th scope="col">Parts No</th>
                            <th scope="col">Nomenclature</th>
                            <th scope="col">qty</th>
                            <!-- <th scope="col">Status</th> -->
                            <th scope="col">Action</th>
                        </tr>
                    </thead> --}}
                    {{-- <tbody>
                        @forelse ($quotation as $item)
                        <tr>
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
                    </tbody> --}}

                </table>
            </div>
        </div>
    </div>
</x-master>