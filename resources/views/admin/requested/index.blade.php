<x-master>
    <x-slot:title>
     Requested Orders
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
                    <h4 class="h2">{{__('Requested Orders')}}</h4>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a type="button" href="{{url('admin/requested/create')}}" class="btn btn-sm btn-outline-secondary float-end ">
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
                            <th scope="col">Requested No.</th>
                            <th scope="col">Total Item</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-master>